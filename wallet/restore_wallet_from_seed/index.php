<?php 
//*desc: Creates a new wallet.
//*desc: NOTE: RPC wallet must have --wallet-dir flag set to work
//*desc: WARNING: This function requires you to send your restored wallet password to the server
//*desc: WARNING: This function requires you to send your mnemonic seed to the server
//*filename: the file name of the newly created wallet
//*seed: The mnemonic seed of the wallet to restore
//*seed_offset: The offset used to originally generate the seed (optional, default: null)
//*password: Password of the new wallet (optional)
//*language: the private view key of the receiver (optional, default: English)
//*restore_height: The height to restore the wallet from (optional, default: 0)
require_once('../../lib/config.php');
require_once('../../lib/helper.php');

$error = false;
$restore_height = 0;
$language = 'English';
$password = '';
$seed_offset = '';

if (!isset($_GET['filename'])) {
    echo 'Need parameter: filename\n';
    $error = true;
}

if (!isset($_GET['seed'])) {
    echo 'Need parameter: seed\n';
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

if (isset($_GET['seed_offset'])) {
    $seed_offset = $_GET['seed_offset'];
}


$params = array(
    'restore_height' => $restore_height,
    'filename' => $_GET['filename'],
    'seed' => $_GET['seed'],
    'seed_offset' => $seed_offset,
    'password' => $password,
    'language' => $language,
);

$json = send_json_rpc_request(HOST, WALLET_PORT, 'restore_wallet_from_seed', $params);
echo $json;
?>
