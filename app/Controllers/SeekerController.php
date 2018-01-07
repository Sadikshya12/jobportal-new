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

class SeekerController extends Controller
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
        $this->redirect('/seeker/applied');
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
                $this->redirect('/seeker/applied');

            } catch (\Exception $e) {
                set_flash('danger', $e->getMessage());
                $this->redirect('/seeker/applied');
            }
        }

        $view_data['job'] = $job;
        $this->render('job/cancel', $view_data);
    }

}