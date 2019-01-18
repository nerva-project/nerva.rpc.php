<?php 
//*desc: extracts the TX public key from the TX.Extra data
//*extra: TX.Extra field to extract the pubkey from
require_once('./lib/config.php');
require_once('./lib/helper.php');

$params = array(
    "extra" => $_GET["extra"],
);

$json = send_request(HOST, PORT, "get_tx_pubkey", $params);
echo $json;
?>