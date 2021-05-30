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

require_once 'vendor' .DS. 'autoload.php';

// Let's go now !
App::getApp()->start();
