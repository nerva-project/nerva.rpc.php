<?php 
require_once('./lib/config.php');

$params = array(
    "include_blob" => false
);

$s = json_encode($params);

$ch = curl_init();
$url = 'http://'.HOST.':'.PORT.'/get_transaction_pool';

curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-type: application/json'));
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_POSTFIELDS, $s);
$obj=curl_exec($ch);
curl_close($ch);

$json = json_decode($obj);

if(!array_key_exists('transactions', $json))
{
print_r($obj);
return;
}

$txs = $json->transactions;
$ski = $json->spent_key_images;
$formatted = array();

foreach ($txs as &$x)
{
    $tx = new stdClass();

    $f = $x->tx_json;
    trim($f,'"');
    $f = str_replace(array("\\n", "\\r"), '', $f);
    $f = stripslashes($f);
    $tx->double_spend_seen = $x->double_spend_seen;
    $tx->do_not_relay = $x->do_not_relay;
    $tx->fee = $x->fee;
    $tx->id_hash = $x->id_hash;
    $tx->kept_by_block = $x->kept_by_block;
    $tx->last_failed_height = $x->last_failed_height;
    $tx->last_failed_id_hash = $x->last_failed_id_hash;
    $tx->last_relayed_time = $x->last_relayed_time;
    $tx->max_used_block_height = $x->max_used_block_height;
    $tx->receive_time = $x->receive_time;
    $tx->relayed = $x->relayed;
    $tx->json = json_decode($f);
    $formatted[] = $tx;
}

$res = new stdClass();
$res->spent_key_images = $ski;
$res->result = $formatted;

print_r(json_encode($res));
?>
