<?php

namespace App\Core;
class Controller
{

    public $session;

    public function __construct()
    {
        $this->session = new Session();
    }

    public function render($view = "", $data = null)
    {
        if ($data) {
            extract($data);
        }

        $path = dirname(__DIR__) . DIRECTORY_SEPARATOR . 'Views' . DIRECTORY_SEPARATOR . $view . '.php';
        include $path;
    }

    public function redirect($url)
    {
        header("Location: $url");
        exit(1);
    }

}