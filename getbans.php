<?php 
//*desc: Gets a list of nodes blocked by this node
require_once('./lib/config.php');
require_once('./lib/helper.php');

$json = send_request(HOST, PORT, "get_bans", null);
echo $json;
?>
