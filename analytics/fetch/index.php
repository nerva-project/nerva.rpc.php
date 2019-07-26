<?php
//*desc: Fetch analytics data
require_once('./lib/config.php');
require_once('./lib/analytics_helper.php');

$limit = 7;

if (isset($_GET["limit"])) {
    $limit = $_GET["limit"];
}

$params = array(
    "time" => strtotime('today midnight'),
    "limit" => $limit
);

$json = send_request(ANALYTICS_HOST, ANALYTICS_PORT, "fetch", $params);
echo $json;
?>
