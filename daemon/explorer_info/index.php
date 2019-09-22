<?php 
//*desc: gets the current node information
require_once('../../lib/config.php');
require_once('../../lib/helper.php');

header('Access-Control-Allow-Origin: http://localhost');

$json = send_json_rpc_request(HOST, DAEMON_PORT, 'get_info', null);
$arr = json_decode($json);
echo json_encode($arr->result);
?>
