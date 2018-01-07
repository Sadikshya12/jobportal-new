<?php

namespace App\Controllers;

use App\Core\Controller;
use App\Core\Database;
use App\Core\Model;
use App\Repositories\Mysql\MySQLApplicationRepository;
use App\Repositories\Mysql\MySQLJobRepository;
use App\Repositories\Mysql\MySQLUserRepository;
use App\Services\JobService;
use App\Services\UserService;

class PosterController extends Controller
{

    protected $jobService;
    protected $userService;

    public function __construct()
    {
        parent::__construct();
        if (!isLoggedIn()) {
            set_flash('danger', 'you need to be logged in.');
            $this->redirect('/index/login');
        }

        $this->jobService = new JobService(
            new MySQLJobRepository(new Database()),
            new MySQLApplicationRepository(new Database())
        );

        $this->userService = new UserService(new MySQLUserRepository(new Database()));
    }

    public function post_new()
    {

        if (!$this->userService->isJobPoster($this->session->get('logged_in_user_id'))) {
            die('Sorry you have no authorization to post new job.');
        }

        if ($_POST) {
            try {
                $this->jobService->postNewJob($_POST, $this->session->get('logged_in_user_id'));
                set_flash('success', 'New job posted.');
                return $this->redirect('/poster/posted');
            } catch (\Exception $e) {
                set_inputs($_POST);
                set_flash('danger', $e->getMessage());
                return $this->redirect('/poster/new');
            }

        }

        return $this->render('job/post_new');

    }

    public function posted()
    {
        if (!$this->userService->isJobPoster($this->session->get('logged_in_user_id'))) {
            die('Sorry you have no authorization to post new job.');
        }

        $jobs = $this->jobService->getByUserId($this->session->get('logged_in_user_id'));

        $view_data['jobs'] = $jobs;
        return $this->render('job/posted', $view_data);

    }

    public function applications(){
        $applications = $this->jobService->getAllReceivedApplications($this->session->get('logged_in_user_id'));
        $view_data['applications'] = $applications;
        $this->render('job/applications', $view_data);
    }

    public function accept_application($applicationId){

        try{
            $this->jobService->updateApplicationStatus(
                'accepted',
                $applicationId,
                $this->session->get('logged_in_user_id')
            );
            set_flash('success', 'Application accepted.');
            $this->redirect('/poster/applications');
        } catch (\Exception $e){
            set_flash('danger', $e->getMessage());
            $this->redirect('/poster/applications');
        }

    }

    public function reject_application($applicationId){

        try{
            $this->jobService->updateApplicationStatus(
                'rejected',
                $applicationId,
                $this->session->get('logged_in_user_id')
            );
            set_flash('success', 'Application rejected.');
            $this->redirect('/poster/applications');
        } catch (\Exception $e){
            set_flash('danger', $e->getMessage());
            $this->redirect('/poster/applications');
        }

    }

    public function delete($jobId)
    {
        try {
            $this->jobService->delete($jobId, $this->session->get('logged_in_user_id'));
            set_flash('success', 'Job deleted.');
            $this->redirect('/poster/posted');
        } catch (\Exception $e) {
            set_flash('danger', $e->getMessage());
            $this->redirect('/poster/posted');
        }

    }


}