<?php  
include ("phprpc/phprpc_client.php");  
$client = new PHPRPC_Client('http://127.0.0.1/tflowg/service.php'); 
header("Content-type: text/html; charset=utf-8");
$s = 'Flowg';
echo $client->invoke('hello',$s,false); 