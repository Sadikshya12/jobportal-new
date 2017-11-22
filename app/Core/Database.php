<?php

namespace App\Core;

class Database
{

    protected static $connection;

    public static function connect()
    {

        if (!isset(self::$connection)) {
            self::$connection = new \mysqli (
                config('database.hostname'),
                config('database.username'),
                config('database.password'),
                config('database.database')
            );
        }

        if (self::$connection === false) {
            return false;
        }

        return self::$connection;

    }

}