<?php
//*desc: Gets the number of blocks in the longest chain
require_once('./lib/config.php');
require_once('./lib/analytics_helper.php');

$limit = $_GET["limit"];

if (!isset($limit)) {
    $limit = 0;
}

$params = array(
    "time" => strtotime('today midnight'),
    "limit" = $_GET["limit"],
);

$json = send_request(ANALYTICS_HOST, ANALYTICS_PORT, "fetch", $params);
echo $json;
?>
