<?php 
//*desc: Creates a new wallet.
//*desc: NOTE: RPC wallet must have --wallet-dir flag set to work
//*desc: WARNING: This function requires you to send your restored wallet password to the server
//*desc: WARNING: This function requires you to send your private keys to the server
//*filename: The file name of the newly created wallet
//*address: The address of the wallet to restore
//*spendkey: The private spend key of the wallet to restore
//*viewkey: The private view key of the wallet to restore
//*password: Password of the new wallet (optional)
//*language: The language to use for the restored wallet seed (optional, default: 'English')
//*restore_height: The height to restore the wallet from (optional, default: 0)
require_once('../../lib/config.php');
require_once('../../lib/helper.php');

$error = false;
$restore_height = 0;
$language = 'English';
$password = '';

if (!isset($_GET['filename'])) {
    echo 'Need parameter: filename\n';
    $error = true;
}

if (!isset($_GET['address'])) {
    echo 'Need parameter: address\n';
    $error = true;
}

if (!isset($_GET['spendkey'])) {
    echo 'Need parameter: spendkey\n';
    $error = true;
}

if (!isset($_GET['viewkey'])) {
    echo 'Need parameter: viewkey\n';
    $error = true;
}

if ($error)
    exit;

if (isset($_GET['restore_height'])) {
    $restore_height = $_GET['restore_height'];
}

if (isset($_GET['language'])) {
    $language = $_GET['language'];
}

if (isset($_GET['password'])) {
    $password = $_GET['password'];
}

$params = array(
    'restore_height' => $restore_height,
    'filename' => $_GET['filename'],
    'address' => $_GET['address'],
    'spendkey' => $_GET['spendkey'],
    'viewkey' => $_GET['viewkey'],
    'password' => $password,
    'language' => $language,
);

$json = send_json_rpc_request(HOST, WALLET_PORT, 'restore_wallet_from_keys', $params);
echo $json;
?>
