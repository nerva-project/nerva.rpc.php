<?php 
//*desc: Get market data from TradeOgre
$ch = curl_init();
$url = 'https://tradeogre.com/api/v1/ticker/BTC-XNV';

curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-type: application/json'));
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
$obj=curl_exec($ch);
curl_close($ch);

$json = json_decode($obj, true);

$data = array(
    "bid" => $json['bid'],
    "ask" => $json['ask'],
    "volume" => $json['volume']);

$retval = json_encode($data);

print_r($retval);

?>