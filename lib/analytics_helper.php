<?php 
function generate_json_rpc_header($method, $params)
{
    $header = array(
        "method" => $method
    );

    if ($params != NULL)
        $header["params"] = $params;

    return json_encode($header);
}

function send_request($host, $port, $method, $params)
{
    $s = generate_json_rpc_header($method, $params);

    $ch = curl_init();
    $url = 'http://'.$host.':'.$port.'/'.$method;

    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-type: application/json'));
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $s);
    $obj=curl_exec($ch);
    curl_close($ch);

    return $obj;
}
?>