<?php

namespace App\Controllers;

use App\Core\Controller;
use App\Core\Database;
use App\Models\User;

class IndexController extends Controller
{
    public function index()
    {
        $user = new User();
        $users = $user->lists();

       return $this->render('home', ['users' => $users]);
    }

    public function login(){
    	return $this->render('login');
    }

    public function register(){
    	return $this->render('register');
    }
}