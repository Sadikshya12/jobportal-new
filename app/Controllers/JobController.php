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
    protected $userService;

    public function __construct()
    {
        parent::__construct();

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

}
