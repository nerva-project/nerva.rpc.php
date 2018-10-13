<?php 
require_once('./lib/config.php');
require_once('./lib/helper.php');

$params = array(
    "extra" => $_GET["extra"],
);

$json = send_request(HOST, PORT, "get_tx_pubkey", $params);
echo $json;
?>