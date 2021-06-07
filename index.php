<?php

use App\App;

// Path constants
define( 'DS', DIRECTORY_SEPARATOR );
define( 'APP_ROOT', dirname( __FILE__ ) .DS );

// DB constants
define( 'DB_HOST', 'database' );
define( 'DB_NAME', 'lamp' );
define( 'DB_USER', 'lamp' );
define( 'DB_PASS', 'lamp' );
// Constantes de hashage
define( 'HASH_SALT', 'b204ea78027880039feeead33e76e55b' );
define( 'HASH_PEPPER', '52aa10fe7630d308142ce6cd32d0b0ac' );

require_once 'vendor' .DS. 'autoload.php';

// Let's go now !
App::getApp()->start();
