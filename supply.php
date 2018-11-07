<?php 
require_once('./lib/config.php');
require_once('./lib/helper.php');

$json = send_request(HOST, PORT, "get_generated_coins", null);
$c = json_decode($json)->result->coins;
echo ($c / 1000000000000);
?>
