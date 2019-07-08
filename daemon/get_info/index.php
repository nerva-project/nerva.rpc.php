<?php 
//*desc: gets the current node information
require_once('../../lib/config.php');
require_once('../../lib/helper.php');

$json = send_json_rpc_request(HOST, DAEMON_PORT, 'get_info', null);
echo $json;
?>
