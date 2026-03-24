<?php

namespace App\Infrastructure;

use PDO;

class Database
{
    private static ?PDO $connection = null;

    public static function getConnection(): PDO
    {
        if (self::$connection === null) {
            self::$connection = new PDO(
                "mysql:host=127.0.0.1;dbname=billing_system",
                "root",
                ""
            );

            self::$connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        }

        return self::$connection;
    }
}