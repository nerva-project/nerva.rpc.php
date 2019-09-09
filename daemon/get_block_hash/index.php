<?php 
//*desc: Gets a block hash at the specified height
//*height: A height to return a block hash for
require_once('../../lib/config.php');
require_once('../../lib/helper.php');

$error = false;

if (!isset($_GET['height'])) {
    echo 'Need parameter: height\n';
    $error = true;
}

if ($error)
    exit;

$params = array($_GET['height']);

$json = send_json_rpc_request(HOST, DAEMON_PORT, 'on_get_block_hash', $params);
echo $json;
?>