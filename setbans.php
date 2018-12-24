<?php 
require_once('./lib/config.php');
require_once('./lib/helper.php');

$pre = '{"jsonrpc":"2.0","id":"0","method":"get_bans","params":{"bans":[{"host":"'.$_GET["ip"].'","ban":'.$_GET["ban"].',"seconds":'.$_GET["time"].'}]}}';
$json = send_request_preformatted(HOST, PORT, "set_bans", $pre);
echo $json;
?>
