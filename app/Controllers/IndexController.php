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

        return $this->render('hello', ['users' => $users]);
    }
}