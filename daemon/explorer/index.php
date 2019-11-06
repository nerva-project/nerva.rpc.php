<?php 
//*desc: gets the current node information
require_once('../../lib/config.php');
require_once('../../lib/helper.php');

if (!isset($_GET['endpoint'])) {
    echo 'Need parameter: endpoint\n';
    $error = true;
}

if ($error)
    exit;

$endpoint=$_GET['endpoint'];

$json = send_json_rpc_request(HOST, DAEMON_PORT, $endpoint, null);
$arr = json_decode($json);
echo json_encode($arr->result);
?>
