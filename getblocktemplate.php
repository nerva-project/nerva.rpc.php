<?php 
//*desc: Gets a block template
//*address: Miner address to generate block template for
//*res: Reserve size
require_once('./lib/config.php');
require_once('./lib/helper.php');

$error = false;

if (!isset($_GET["address"])) {
    echo "Need parameter 'address'\n";
    $error = true;
}

if (!isset($_GET["reserve_size"])) {
    echo "Need parameter 'reserve_size'\n";
    $error = true;
}

if ($error)
    exit;

$params = array(
    "wallet_address" => $_GET["address"],
    "reserve_size" => $_GET["res"],
);

$json = send_request(HOST, PORT, "get_block_template", $params);
echo $json;
?>
