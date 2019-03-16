<?php 
//*desc: Decodes the amounts in the transaction hashes provided
//*desc: WARNING: This function requires you to send your private view key to the server
//*hash[]: list of hashes to get tx data for
//*address: the public address of the receiver
//*viewkey: the private view key of the receiver
//*example: gettransactions.php?hash[]=(hash1)&hash[]=(hash2)
require_once('./lib/config.php');
require_once('./lib/helper.php');

$hashes = $_GET['hash'];
$address = $_GET['address'];
$viewkey = $_GET['viewkey'];
$params = array(
    "tx_hashes" => $hashes,
    "address" => $address,
    "sec_view_key" => $viewkey
);

$json = send_request(HOST, PORT, "decode_outputs", $params);
echo $json;
?>
