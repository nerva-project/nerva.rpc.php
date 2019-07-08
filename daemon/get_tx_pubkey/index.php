<?php 
//*desc: Extracts the TX public key from the TX.Extra data
//*extra: TX.Extra field to extract the pubkey from
require_once('../../lib/config.php');
require_once('../../lib/helper.php');

$error = false;

if (!isset($_GET['extra'])) {
    echo 'Need parameter: extra\n';
    $error = true;
}

if ($error)
    exit;

$params = array(
    'extra' => $_GET['extra'],
);

$json = send_json_rpc_request(HOST, DAEMON_PORT, 'get_tx_pubkey', $params);
echo $json;
?>