<?php

namespace App\Controllers;

use App\Core\Controller;
use App\Core\Database;
use App\Core\Model;
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

        $this->jobService = new JobService(new MySQLJobRepository(new Database()));
        $this->userService = new UserService(new MySQLUserRepository(new Database()));
    }

    public function index()
    {
        return $this->render('job');
    }

    public function details($job_id)
    {
        $view_data['job'] = $this->jobService->getById($job_id);
        return $this->render('job/jobdescription', $view_data);
    }

    public function search(){
        $view_data['jobs'] = $this->jobService->search($_GET);

        return $this->render('job/search', $view_data);
    }

    public function logout()
    {
        $this->session->remove('logged_in_user_id');
        set_flash('success', 'Logout success.');
        $this->redirect('/index/login');
    }

    public function post_new(){

        if(!$this->userService->isJobPoster($this->session->get('logged_in_user_id'))){
            die('Sorry you have no authorization to post new job.');
        }

        if($_POST){
            try {
                $this->jobService->postNewJob($_POST, $this->session->get('logged_in_user_id'));
                set_flash('success', 'New job posted.');
                return $this->redirect('/job/posted');
            } catch (\Exception $e){
                set_inputs($_POST);
                set_flash('danger', $e->getMessage());
                return $this->redirect('/job/new');
            }

        }

        return $this->render('job/post_new');

    }

    public function posted(){
        if(!$this->userService->isJobPoster($this->session->get('logged_in_user_id'))){
            die('Sorry you have no authorization to post new job.');
        }

        $jobs = $this->jobService->getByUserId($this->session->get('logged_in_user_id'));

        $view_data['jobs'] = $jobs;
        return $this->render('job/posted', $view_data);

    }

    public function delete($jobId){
        try{
            $this->jobService->delete($jobId, $this->session->get('logged_in_user_id'));
            set_flash('success', 'Job deleted.');
            $this->redirect('/job/posted');
        } catch (\Exception $e){
            set_flash('danger', $e->getMessage());
            $this->redirect('/job/posted');
        }

    }
}
