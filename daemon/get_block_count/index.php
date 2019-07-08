<?php 
//*desc: Gets the number of blocks in the longest chain
require_once('../../lib/config.php');
require_once('../../lib/helper.php');

$json = send_json_rpc_request(HOST, DAEMON_PORT, 'get_block_count', null);
echo $json;
?>
