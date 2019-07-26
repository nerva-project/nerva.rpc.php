<?php
//*desc: Prune stale nodes from the node map. Requires and API key
require_once('./lib/config.php');
require_once('./lib/analytics_helper.php');

$params = array(
    "time" => strtotime('today midnight'),
    "limit" = $_GET["limit"],
    "key" = $_GET["key"],
    "dryrun" = true
);

$json = send_request(ANALYTICS_HOST, ANALYTICS_PORT, "prune", $params);
$arr = json_decode($json);

if (!isset($arr) || !isset($arr->status)) {
    http_response_code(500);
    return;
}

if ($arr->status == "OK") {
    http_response_code(200);
}
else {
    http_response_code(500);
}
?>
