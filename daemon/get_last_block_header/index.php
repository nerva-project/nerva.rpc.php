<?php 
//*desc: Gets the last block header
require_once('../../lib/config.php');
require_once('../../lib/helper.php');

$json = send_json_rpc_request(HOST, DAEMON_PORT, 'get_last_block_header', null);
echo $json;
?>
