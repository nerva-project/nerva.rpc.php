<?php 
define('HOST', 'localhost');
define('DAEMON_PORT', 17566);
define('WALLET_PORT', 19566);
define('ANALYTICS_HOST', HOST);
define('ANALYTICS_PORT', 15236);
define('DEBUG', true);

header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');

if (DEBUG)
{
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);
}
?>
