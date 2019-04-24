<?php 
define('HOST', '127.0.0.1');
define('PORT', 22424);
define('ANALYTICS_HOST', HOST);
define('ANALYTICS_PORT', 12345);
define('DEBUG', true);

header('Content-Type: application/json');

if (DEBUG)
{
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);
}
?>
