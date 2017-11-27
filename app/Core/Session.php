<?php

namespace App\Core;

class Session
{

    public function all()
    {
        return $_SESSION;
    }

    public function set($key, $value)
    {
        $_SESSION[$key] = $value;
    }

    public function remove($key)
    {
        if(isset($_SESSION[$key])){
            unset($_SESSION[$key]);
        }
    }

    public function get($key)
    {
        if(isset($_SESSION[$key])){
            return $_SESSION[$key];
        }
    }

}