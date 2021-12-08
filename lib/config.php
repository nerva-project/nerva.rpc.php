<?php 
define('HOST', 'localhost');
define('DAEMON_PORT', 17566);
define('WALLET_PORT', 22525);

define('ANALYTICS_DISABLED', true);
define('DB_SERVER_NAME', 'localhost');
define('DB_DATABASE_NAME', 'node_map');
define('DB_USER_NAME', 'YOUR_DATABASE_USER_NAME');
define('DB_USER_PASSWORD', 'YOUR_DATABASE_USER_PASSWORD');

define('LOG_FILE', "/var/www/logs/php.log");

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