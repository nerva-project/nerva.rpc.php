<?php 
//*desc: Gets the block headers in the specified range
//*start_height: Height of the first block in the 
//*end_height: Height of the last block in the range
require_once('../../lib/config.php');
require_once('../../lib/helper.php');

$error = false;

if (!isset($_GET['start'])) {
    echo 'Need parameter: start\n';
    $error = true;
}

if (!isset($_GET['end'])) {
    echo 'Need parameter: end\n';
    $error = true;
}

if ($error)
    exit;

$params = array(
    'start_height' => $_GET['start'],
    'end_height' => $_GET['end']
);

$json = send_json_rpc_request(HOST, DAEMON_PORT, 'get_block_headers_range', $params);
echo $json;
?>