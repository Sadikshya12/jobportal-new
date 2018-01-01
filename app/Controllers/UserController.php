<?php

namespace App\Controllers;

use App\Core\Controller;
use App\Core\Database;
use App\Repositories\Mysql\MySQLUserRepository;
use App\Services\UserService;

class UserController extends Controller
{

    protected $userService;

    public function __construct(){
            parent::__construct();
        if(!isLoggedIn()){
            set_flash('danger', 'you need to be logged in.');
            $this->redirect('/index/login');
        }

        $this->userService = new UserService(new MySQLUserRepository(new Database()));
    }

    public function index()
    {
        return $this->render('user');
    }

    public function myaccount()
    {
        $user = $this->userService->findById($this->session->get('logged_in_user_id'));

        $view_data['user'] = $user;
        return $this->render('user/myaccount', $view_data);
    }

    public function logout(){
        $this->session->remove('logged_in_user_id');
        set_flash('success', 'Logout success.');
        $this->redirect('/index/login');
    }
}