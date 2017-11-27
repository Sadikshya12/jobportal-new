<?php

namespace App\Controllers;

use App\Core\Controller;

class UserController extends Controller
{
    public function index()
    {
        return $this->render('user');
    }

    public function myaccount()
    {
        return $this->render('user/myaccount');
    }

    public function logout(){
        $this->session->remove('logged_in_user_id');
        set_flash('success', 'Logout success.');
        $this->redirect('/index/login');
    }
}