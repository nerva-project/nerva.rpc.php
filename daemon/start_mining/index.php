<?php 
//*desc: Starts mining on the node
//*address: The address to mine to
//*threads: The number of threads to use (optional, default: 0/auto)
//*background: Set to mine in the background (optional, default: false)
//*ignore_battery: Ignore battery level when mining (optional, default: true)
require_once('../../lib/config.php');

$error = false;
$background = false;
$ignore_battery = true;
$threads = 0;

if (!isset($_GET['address'])) {
    echo 'Need parameter: address\n';
    $error = true;
}

if ($error)
    exit;

if (isset($_GET['background'])) {
    $background = $_GET['background'];
}
    
if (isset($_GET['ignore_battery'])) {
    $ignore_battery = $_GET['ignore_battery'];
}
    
if (isset($_GET['threads'])) {
    $threads = $_GET['threads'];
}

$address = $_GET['address'];
$params = array(
    'miner_address' => $address,
    'do_background_mining' => $background,
    'ignore_battery' => $ignore_battery,
    'threads_count' => $threads
);

$s = json_encode($params);

$ch = curl_init();
$url = 'http://'.HOST.':'.DAEMON_PORT.'/start_mining';

curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-type: application/json'));
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_POSTFIELDS, $s);
$obj=curl_exec($ch);
curl_close($ch);

echo $obj;
?>
