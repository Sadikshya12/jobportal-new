<?php

namespace App\Core;
class Controller
{

    public function render($view = "", $data = null)
    {
        if ($data) {
            extract($data);
        }

        $path = dirname(__DIR__) . '/Views/' . $view . '.php';
        include $path;
    }

}