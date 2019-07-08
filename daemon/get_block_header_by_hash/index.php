<?php 
//*desc: Gets a block header by it's hash
//*hash: Block hash to search for
require_once('../../lib/config.php');
require_once('../../lib/helper.php');

$error = false;

if (!isset($_GET['hash'])) {
    echo 'Need parameter: hash\n';
    $error = true;
}

if ($error)
    exit;

$params = array(
    'hash' => $_GET['hash']
);

$json = send_json_rpc_request(HOST, DAEMON_PORT, 'get_block_header_by_hash', $params);
echo $json;
?>
