<?php

namespace App\Core;
class Controller
{

    public function render($view = "", $data = null)
    {
        if ($data) {
            extract($data);
        }

        $path = dirname(__DIR__) . DIRECTORY_SEPARATOR . 'Views' . DIRECTORY_SEPARATOR . $view . '.php';
        include $path;
    }

}