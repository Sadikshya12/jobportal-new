<?php

namespace App\Controllers;

use App\Core\Controller;
use App\Models\Job;

class JobController extends Controller
{

    public function __construct(){
            parent::__construct();
        //  if(!isLoggedIn()){
        //      set_flash('danger', 'you need to be logged in.');
        //      $this->redirect('/index/login');
        // }
    }

    public function index()
    {
        return $this->render('Job');
    }

    public function latest()
    {
        $job = new Job();
        $view_data['jobs'] = $job->getAllLatest();
        return $this->render('Job/latest', $view_data);
    }

     public function jobdescription($job_id)
    {
        $job = new Job();
        $view_data['job'] = $job->getById($job_id);
        return $this->render('Job/jobdescription', $view_data);
    }

     public function enterjobdescription()
    {
        //$job = new Job();
        //$view_data['job'] = $job->getById($job_id);
        return $this->render('Job/enterjobdescription');
    }

    public function logout(){
        $this->session->remove('logged_in_user_id');
        set_flash('success', 'Logout success.');
        $this->redirect('/index/login');
    }
}
