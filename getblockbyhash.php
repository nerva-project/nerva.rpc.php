<?php 
require_once('./lib/config.php');
require_once('./lib/helper.php');

$params = array(
    "hash" => $_GET["hash"]
);

$json = send_request(HOST, PORT, "get_block", $params);
echo $json;
?>
