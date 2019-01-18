<?php 
//*desc: Gets a block header by it's height
//*hash: Block height to search for
require_once('./lib/config.php');
require_once('./lib/helper.php');

$params = array(
    "height" => $_GET["height"]
);

$json = send_request(HOST, PORT, "get_block_header_by_height", $params);
echo $json;
?>
