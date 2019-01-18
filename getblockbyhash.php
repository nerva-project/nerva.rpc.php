<?php 
//*desc: Gets a block by it's hash
//*hash: Block hash to search for
require_once('./lib/config.php');
require_once('./lib/helper.php');

$params = array(
    "hash" => $_GET["hash"]
);

$json = send_request(HOST, PORT, "get_block", $params);
$arr = json_decode($json);
$f = $arr->result->json;
trim($f,'"');
$f = str_replace(array("\\n", "\\r"), '', $f);
$f = stripslashes($f);

$json_arr = json_decode($f);
$arr->result->json = $json_arr;

$formatted = json_encode($arr);

print_r($formatted);

?>
