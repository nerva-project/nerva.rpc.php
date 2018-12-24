<?php 
require_once('./lib/config.php');
require_once('./lib/helper.php');

$params = array(
    "host" => $_GET["ip"],
    "ban" => $_GET["ban"],
    "seconds" => $_GET["time"]
);

$json = send_request(HOST, PORT, "set_bans", $params);
echo $json;
?>