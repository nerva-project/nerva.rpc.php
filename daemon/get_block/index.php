<?php 
//*desc: Gets a block by it's hash
//*hash: Block hash to search for
require_once('../../lib/config.php');
require_once('../../lib/helper.php');

$params = array();
$error = false;

if (!isset($_GET['hash']) && !isset($_GET['height'])) {
    echo 'Need parameter: hash or height\n';
    $error = true;
}

if (isset($_GET['hash']) && isset($_GET['height'])) {
    echo 'Cannot process both a hash and height.\n';
    $error = true;
}

if ($error)
    exit;

if (isset($_GET['hash'])) {
    $params += ['hash' => $_GET['hash']];
}
else if (isset($_GET['height'])) {
    $params += ['height' => $_GET['height']];
}

$json = send_json_rpc_request(HOST, DAEMON_PORT, 'get_block', $params);
$arr = json_decode($json);
if ($arr->result == null) {
    echo $json;
}
else {
    $f = $arr->result->json;
    trim($f,'"');
    $f = str_replace(array("\\n", "\\r"), '', $f);
    $f = stripslashes($f);

    $json_arr = json_decode($f);
    $arr->result->json = $json_arr;

    $formatted = json_encode($arr);

    print_r($formatted);
}

?>
