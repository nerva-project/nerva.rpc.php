<?php 
//*desc: Gets hardfork information
require_once('../../lib/config.php');
require_once('../../lib/helper.php');

$json = send_json_rpc_request(HOST, DAEMON_PORT, 'hard_fork_info', null);
echo $json;
?>