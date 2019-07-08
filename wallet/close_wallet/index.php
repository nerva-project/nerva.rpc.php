<?php 
//*desc: Closes the open wallet.
//*desc: NOTE: RPC wallet must have --wallet-dir flag set to work
require_once('../../lib/config.php');
require_once('../../lib/helper.php');

$json = send_json_rpc_request(HOST, WALLET_PORT, 'close_wallet', null);
echo $json;
?>