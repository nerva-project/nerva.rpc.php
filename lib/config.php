<?php 
define('HOST', '127.0.0.1');
define('PORT', 17566);
define('DEBUG', true);

header('Content-Type: application/json');

if (DEBUG)
{
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);
}
?>
