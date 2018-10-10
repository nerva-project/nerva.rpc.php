<?php 
require_once('./lib/config.php');
require_once('./lib/helper.php');

$params = array(
    "height" => $_GET["height"]
);

$json = send_request(HOST, PORT, "get_block_header_by_height", $params);
echo $json;
?>
