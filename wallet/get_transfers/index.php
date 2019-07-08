<?php 
//*desc: Gets the transfers to/from the wallet.
//*account_index: Index to get the transfer for (optional, default: 0)
//*min_height: The minimum height to return results from (optional, default: 0)
require_once('../../lib/config.php');
require_once('../../lib/helper.php');

$account_index = 0;
$in = true;
$out = true;
$pending = true;
$min_height = 0;

if (isset($_GET['account_index'])) {
    $account_index = $_GET['account_index'];
}

if (isset($_GET['min_height'])) {
    $account_index = $_GET['min_height'];
}

$params = array(
    'account_index' => $account_index,
    'in' => $in,
    'out' => $out,
    'pending' => $pending,
    'pool' => false,
    'min_height' => $min_height
);

$json = send_json_rpc_request(HOST, WALLET_PORT, 'get_transfers', $params);
echo $json;
?>