<?php 
//*desc: Decodes the amounts in the transaction hashes provided
//*desc: WARNING: This function requires you to send your private view key to the server
//*hash[]: list of hashes to get tx data for
//*address: the public address of the receiver
//*viewkey: the private view key of the receiver
//*example: gettransactions.php?hash[]=(hash1)&hash[]=(hash2)
require_once('../../lib/config.php');
require_once('../../lib/helper.php');

$error = false;

if (!isset($_GET['hash'])) {
    echo 'Need parameter: hash\n';
    $error = true;
}

if (!isset($_GET['address'])) {
    echo 'Need parameter: address\n';
    $error = true;
}

if (!isset($_GET['viewkey'])) {
    echo 'Need parameter: viewkey\n';
    $error = true;
}

if ($error)
    exit;
    
$params = array(
    'tx_hashes' => $_GET['hash'],
    'address' => $_GET['address'],
    'sec_view_key' => $_GET['viewkey']
);

$json = send_json_rpc_request(HOST, DAEMON_PORT, 'decode_outputs', $params);
echo $json;
?>
