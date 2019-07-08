<?php 
//*desc: Gets the balance of the wallet.
//*desc: NOTE: RPC wallet must have --wallet-dir flag set to work
//*account_index: Index to get the balance of (optional, default: 0)
require_once('../../lib/config.php');
require_once('../../lib/helper.php');

//TODO: accept an array of subaddress indices
$account_index = 0;

if (isset($_GET['account_index'])) {
    $account_index = $_GET['account_index'];
}

$params = array(
    'account_index' => $account_index,
);

$json = send_json_rpc_request(HOST, WALLET_PORT, 'get_balance', $params);
echo $json;
?>