<?php 
//*desc: Opens a wallet.
//*desc: NOTE: RPC wallet must have --wallet-dir flag set to work
//*desc: WARNING: This function requires you to send your wallet password to the server
//*filename: The file name of the newly created wallet
//*password: Password of the new wallet (optional, leave blank for no password)
require_once('../../lib/config.php');
require_once('../../lib/helper.php');

$error = false;
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

$params = array(
    'filename' => $_GET['filename'],
    'password' => $password,
);

$json = send_json_rpc_request(HOST, WALLET_PORT, 'open_wallet', $params);
echo $json;
?>