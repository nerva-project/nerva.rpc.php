<?php 
//*desc: gets the current node information
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

ob_start();
include '../'.$endpoint.'/index.php';
$json = ob_get_clean();

$arr = json_decode($json);
if (isset($arr->result)) {
    echo json_encode($arr->result);
} else {
    echo $json;
}

?>
