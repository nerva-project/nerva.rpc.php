<?php
//*desc: Gets the number of blocks in the longest chain
require_once('./lib/config.php');
require_once('./lib/analytics_helper.php');

$json = send_request(ANALYTICS_HOST, ANALYTICS_PORT, "fetch", NULL);
echo $json;
?>
