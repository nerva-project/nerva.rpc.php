<?php
//*desc: Submits the callers IP address to the node map
require_once('../../lib/config.php');
require_once('../../lib/analytics_helper.php');

$ip = 'NA';
$ua = 'NA';
 
//Check to see if the CF-Connecting-IP header exists.
if(isset($_SERVER["HTTP_CF_CONNECTING_IP"])){
    //If it does, assume that PHP app is behind Cloudflare.
    $ip = $_SERVER["HTTP_CF_CONNECTING_IP"];
} else{
    //Otherwise, use REMOTE_ADDR.
    $ip = $_SERVER['REMOTE_ADDR'];
}

//block common lan ip's
if (starts_with($ip, "127.") || starts_with($ip, "10.") || starts_with($ip, "192.")) {
    http_response_code(403);
    return;
}

if (isset($_SERVER['HTTP_USER_AGENT'])) {
    $ua = $_SERVER['HTTP_USER_AGENT'];
}

//block any user agent that does not start with nerva-cli
//a basic check as the ua string can be spoofed, but
//means someone actually has to put in effort to spam it

if ($ua == "NA" || substr($ua, 0, 9) != "nerva-cli") {
    http_response_code(403);
    return;
}

$params = array(
    "version" => substr($ua, 10),
    "address" => $ip,
    "time" => strtotime('today midnight'),
);

$json = send_request(ANALYTICS_HOST, ANALYTICS_PORT, "submit", $params);
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
