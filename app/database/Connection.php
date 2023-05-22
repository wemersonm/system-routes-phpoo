<?php

namespace app\database;

use PDO;

class Connection
{

    private static $connection = null;

    public static function connect()
    {
        if (!self::$connection) {
            self::$connection = new PDO("mysql:host=localhost;dbname=testessql;charset=utf8","root","",[
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
            ]);
        }
        return self::$connection;
        
    }
}
