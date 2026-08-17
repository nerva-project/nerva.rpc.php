<?php 
//*desc: Calls another daemon endpoint and unwraps the result from its json envelope
//*endpoint: name of the daemon endpoint to call, e.g. get_info
//*example: explorer.php?endpoint=get_info
require_once('../../lib/config.php');
require_once('../../lib/helper.php');

$error = false;

if (!isset($_GET['endpoint'])) {
    echo 'Need parameter: endpoint\n';
    $error = true;
}

if ($error)
    exit;

$endpoint=$_GET['endpoint'];

// Only plain endpoint directory names are accepted. Rejecting '.' and '/' keeps
// the include inside daemon/, and rejecting 'explorer' stops it recursing here.
if (!is_string($endpoint) ||
    !preg_match('/^[a-z0-9_]+$/', $endpoint) ||
    $endpoint === 'explorer' ||
    !is_file(__DIR__.'/../'.$endpoint.'/index.php')) {
    http_response_code(400);
    echo json_encode(array('error' => 'Invalid endpoint'));
    exit;
}

ob_start();
include __DIR__.'/../'.$endpoint.'/index.php';
$json = ob_get_clean();

$arr = json_decode($json);
if (isset($arr->result)) {
    echo json_encode($arr->result);
} else {
    echo $json;
}

?>
