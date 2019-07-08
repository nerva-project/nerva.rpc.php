<?php 
//*desc: Gets the address of the wallet.
//*desc: NOTE: RPC wallet must have --wallet-dir flag set to work
//*account_index: The file name of the newly created wallet
require_once('../../lib/config.php');
require_once('../../lib/helper.php');

//TODO: accept an array of subaddress indices

$error = false;

if (!isset($_GET['account_index'])) {
    echo 'Need parameter: account_index\n';
    $error = true;
}

if ($error)
    exit;

$params = array(
    'account_index' => $_GET['acc_idx'],
);

$json = send_json_rpc_request(HOST, WALLET_PORT, 'get_balance', $params);
echo $json;
?>