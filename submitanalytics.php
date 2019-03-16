<?php

$ip = 'NA';
$ua = 'NA';
 
//Check to see if the CF-Connecting-IP header exists.
if(isset($_SERVER["HTTP_CF_CONNECTING_IP"])){
    //If it does, assume that PHP app is behind Cloudflare.
    $ip = $_SERVER["HTTP_CF_CONNECTING_IP"];
} else{
    //Otherwise, use REMOTE_ADDR.
    $ip = $_SERVER['REMOTE_ADDR'];
}

if (isset($_SERVER['HTTP_USER_AGENT'])) {
    $ua = $_SERVER['HTTP_USER_AGENT'];
}

http_response_code(500);
?>
