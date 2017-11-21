<?php

namespace App\Core;
class Controller
{

    public function render($view="")
    {
        $path = dirname(__DIR__).'/Views/'.$view.'.php';
        include $path;
    }

}