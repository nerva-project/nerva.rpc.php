<?php 
require_once('./lib/config.php');
require_once('./lib/helper.php');

$json = send_request(HOST, PORT, "get_last_block_header", null);
echo $json;
?>
