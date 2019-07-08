<?php
//*desc: Gets the number of coins generated in the chain
require_once('../../lib/config.php');
require_once('../../lib/helper.php');

$json = send_json_rpc_request(HOST, DAEMON_PORT, 'get_generated_coins', null);
echo $json;
?>
