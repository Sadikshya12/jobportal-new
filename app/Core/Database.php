<?php

namespace App\Core;

class Database {

    protected static $connection;

    public static function connect(){

        if (!isset(self::$connection)){
            global $config;
            self::$connection = new \mysqli ($config['db']['host'], $config['db']['username'],
                $config['db']['password'],$config['db']['database']);
        }

        if (self::$connection===false){
            return false;
        }
        return self::$connection;

    }

}