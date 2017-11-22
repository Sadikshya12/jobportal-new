<?php

namespace App\Controllers;

use App\Core\Controller;
use App\Core\Database;

class IndexController extends Controller
{
    public function index()
    {
        echo '<pre>';
        print_r(Database::connect());
die;
        return $this->render('hello');
    }
}