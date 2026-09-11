<?php

use Illuminate\Http\Request;

// PHP 8.5 deprecates PDO::MYSQL_ATTR_SSL_CA, which the framework's own
// default database config still references; silence deprecation notices
// so they don't leak into JSON API responses.
error_reporting(E_ALL & ~E_DEPRECATED);

define('LARAVEL_START', microtime(true));

// Determine if the application is in maintenance mode...
if (file_exists($maintenance = __DIR__.'/../storage/framework/maintenance.php')) {
    require $maintenance;
}

// Register the Composer autoloader...
require __DIR__.'/../vendor/autoload.php';

// Bootstrap Laravel and handle the request...
(require_once __DIR__.'/../bootstrap/app.php')
    ->handleRequest(Request::capture());
