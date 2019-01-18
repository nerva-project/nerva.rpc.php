<?php 
//*desc: Gets a block template
//*address: Miner address to generate block template for
//*res: Reserve size
require_once('./lib/config.php');
require_once('./lib/helper.php');

$params = array(
    "wallet_address" => $_GET["address"],
    "reserve_size" => $_GET["res"],
);

$json = send_request(HOST, PORT, "get_block_template", $params);
echo $json;
?>