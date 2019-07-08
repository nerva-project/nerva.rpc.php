<?php 
//*desc: Sweeps the dust outputs back to the wallet.
require_once('../../lib/config.php');
require_once('../../lib/helper.php');

$json = send_json_rpc_request(HOST, WALLET_PORT, 'sweep_dust', null);
echo $json;
?>