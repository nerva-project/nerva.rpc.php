<?php
//*desc: Fetch analytics data
require_once('../../lib/config.php');
require_once('../../lib/analytics_helper.php');

$limit = 7;
$key = 0;
$dryrun = true;

if (isset($_GET["limit"])) {
    $limit = $_GET["limit"];
}

if (isset($_GET["key"])) {
    $key = $_GET["key"];
}

if (isset($_GET["dryrun"])) {
    $dryrun = $_GET["dryrun"];
}

$params = array(
    "time" => strtotime('today midnight'),
    "limit" => $limit,
    "key" => $key,
    "dryrun" => $dryrun
);

$json = send_request(ANALYTICS_HOST, ANALYTICS_PORT, "prune", $params);
echo $json;
?>
