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

class JobController extends Controller
{

    protected $jobService;

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

    public function index()
    {
        return $this->render('job');
    }

    public function details($job_id)
    {
        $job = $this->jobService->getById($job_id);
        if (!$job) {
            die('Job not found. Invalid job id.');
        }

        $view_data['job'] = $job;
        return $this->render('job/jobdescription', $view_data);
    }

    public function search()
    {
        $view_data['jobs'] = $this->jobService->search($_GET);

        return $this->render('job/search', $view_data);
    }

    public function logout()
    {
        $this->session->remove('logged_in_user_id');
        set_flash('success', 'Logout success.');
        $this->redirect('/index/login');
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
                return $this->redirect('/job/posted');
            } catch (\Exception $e) {
                set_inputs($_POST);
                set_flash('danger', $e->getMessage());
                return $this->redirect('/job/new');
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

    public function delete($jobId)
    {
        try {
            $this->jobService->delete($jobId, $this->session->get('logged_in_user_id'));
            set_flash('success', 'Job deleted.');
            $this->redirect('/job/posted');
        } catch (\Exception $e) {
            set_flash('danger', $e->getMessage());
            $this->redirect('/job/posted');
        }

    }

    public function apply($jobId)
    {
        $job = $this->jobService->getById($jobId);
        if (!$job) {
            die('Job not found. Invalid job id.');
        }

        try {
            $this->jobService->apply($job->id, $this->session->get('logged_in_user_id'));
        } catch (\Exception $e) {
            set_flash('danger', $e->getMessage());
            $this->redirect('/job/details/' . $job->id);
        }

        set_flash('success', 'Application sent successfully.');
        $this->redirect('/job/applied');
    }

    public function applied()
    {

        $jobs = $this->jobService->getAllAppliedJobs($this->session->get('logged_in_user_id'));

        $view_data['jobs'] = $jobs;
        $this->render('job/applied', $view_data);

    }

    public function cancel($jobId)
    {
        $job = $this->jobService->getById($jobId);
        if (!$job) {
            die('Invalid job id.');
        }

        if ($_POST) {
            try {
                $this->jobService->cancel($_POST, $job->id, $this->session->get('logged_in_user_id'));

                set_flash('success', 'Job application cancelled.');
                $this->redirect('/job/applied');

            } catch (\Exception $e) {
                set_flash('danger', $e->getMessage());
                $this->redirect('/job/applied');
            }
        }

        $view_data['job'] = $job;
        $this->render('job/cancel', $view_data);
    }

    public function applications(){
        $applications = $this->jobService->getAllReceivedApplications($this->session->get('logged_in_user_id'));
        $view_data['applications'] = $applications;
        $this->render('job/applications', $view_data);
    }

}
