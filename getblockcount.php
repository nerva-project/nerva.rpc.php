<?php 
require_once('./lib/config.php');
require_once('./lib/helper.php');

$json = send_request(HOST, PORT, "get_block_count", null);
echo $json;
?>
