<?php 
require_once('./lib/config.php');

$hashes=$_GET['hash'];
$params = array(
    "txs_hashes" => $hashes,
    "decode_as_json" => true
);

$s = json_encode($params);

$ch = curl_init();
$url = 'http://'.HOST.':'.PORT.'/get_transactions';

curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-type: application/json'));
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_POSTFIELDS, $s);
$obj=curl_exec($ch);
curl_close($ch);

$txs = json_decode($obj)->txs;
$formatted = array();

foreach ($txs as &$x)
{
    $tx = new stdClass();

    $f = $x->as_json;
    trim($f,'"');
    $f = str_replace(array("\\n", "\\r"), '', $f);
    $f = stripslashes($f);
    $tx->block_height = $x->block_height;
    $tx->block_timestamp = $x->block_timestamp;
    $tx->double_spend_seen = $x->double_spend_seen;
    $tx->in_pool = $x->in_pool;
    $tx->output_indices = $x->output_indices;
    $tx->tx_hash = $x->tx_hash;
    $tx->json = json_decode($f);
    $formatted[] = $tx;
}

$res = new stdClass();
$res->result = $formatted;

print_r(json_encode($res));
?>
