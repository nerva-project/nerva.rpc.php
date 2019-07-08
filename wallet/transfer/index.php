<?php 
//*desc: Transfer funds
//*address: Address to transfer to
//*amount: Amount to send in atomic units
require_once('../../lib/config.php');
require_once('../../lib/helper.php');

$error = false;
//TODO: Implement
//account_index
//payment_id
//priority

//TODO: Allow multiple destinations

$account_index = 0;
$priority = 0;

if (!isset($_GET['address'])) {
    echo 'Need parameter: address\n';
    $error = true;
}

if (!isset($_GET['amount'])) {
    echo 'Need parameter: amount\n';
    $error = true;
}

if ($error)
    exit;

$params = array(
    'destinations' => array(
        array('address' => $address, 'amount' => $amount)
    ),
    'account_index' => $account_index,
    'priority' => $priority,
);

$json = send_json_rpc_request(HOST, WALLET_PORT, 'transfer', $params);
echo $json;
?>
