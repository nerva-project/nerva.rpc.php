<?php 
//*desc: Creates a new wallet.
//*desc: NOTE: RPC wallet must have --wallet-dir flag set to work
//*desc: WARNING: This function requires you to send your password to the server
//*filename: the faile name of the newly created wallet
//*password: Password of the new wallet (optional)
//*language: the private view key of the receiver (optional, default to English)
require_once('../../lib/config.php');
require_once('../../lib/helper.php');

$error = false;
$language = 'English';
$password = '';

if (!isset($_GET['filename'])) {
    echo 'Need parameter: filename\n';
    $error = true;
}

if ($error)
    exit;

if (isset($_GET['password'])) {
    $password = $_GET['password'];
}

if (isset($_GET['language'])) {
    $language = $_GET['language'];
}

$params = array(
    'filename' => $_GET['filename'],
    'password' => $password,
    'language' => $language
);

$json = send_json_rpc_request(HOST, WALLET_PORT, 'create_wallet', $params);
echo $json;
?>
