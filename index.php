<?php

session_start();
error_reporting(E_ALL);
ini_set('display_errors', 1);

require __DIR__.'/vendor/autoload.php';

use App\Router as Router;

$fc = new Router();
$fc->run();