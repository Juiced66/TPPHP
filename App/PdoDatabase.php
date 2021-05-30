<?php

/**
 * Class PdoDatabase
 */

namespace App;

use PDO;

class PdoDatabase
{
    private const PDO_DSN_FORMAT = 'mysql:dbname=%s;host=%s';

    private const PDO_OPTIONS = [
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
    ];

    private static ?PDO $pdo_instance = null;

    public static function getPdo(): PDO
    {
        if( is_null( self::$pdo_instance ) ) {
            $dsn = sprintf( self::PDO_DSN_FORMAT, DB_NAME, DB_HOST );

            self::$pdo_instance = new PDO( $dsn, DB_USER, DB_PASS, self::PDO_OPTIONS );
        }

        return self::$pdo_instance;
    }

    // Singleton pattern locks
    private function __construct() { }
    private function __clone() { }
    private function __wakeup() { }
}