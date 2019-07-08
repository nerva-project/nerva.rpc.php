<?php 
//*desc: Block a node by the IP address
//*ip: IP to ban
//*ban: To ban or not true/false
//*time: Number of seconds to ban for
require_once('../../lib/config.php');
require_once('../../lib/helper.php');

$error = false;

if (!isset($_GET['ip'])) {
    echo 'Need parameter: ip\n';
    $error = true;
}

if (!isset($_GET['ban'])) {
    echo 'Need parameter: ban\n';
    $error = true;
}

if (!isset($_GET['time'])) {
    echo 'Need parameter: time\n';
    $error = true;
}

if ($error)
    exit;

//todo: check required query string args exist
$pre = '{"jsonrpc":"2.0","id":"0","method":"set_bans","params":{"bans":[{"host":"'.$_GET["ip"].'","ban":'.$_GET["ban"].',"seconds":'.$_GET["time"].'}]}}';
$json = send_json_rpc_request_preformatted(HOST, DAEMON_PORT, "set_bans", $pre);
echo $json;
?>
