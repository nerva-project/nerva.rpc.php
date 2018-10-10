<?php 
require_once('./lib/config.php');
require_once('./lib/helper.php');

$params = array(
    "start_height" => $_GET["start"],
    "end_height" => $_GET["end"]
);

$json = send_request(HOST, PORT, "get_block_headers_range", $params);
echo $json;
?>