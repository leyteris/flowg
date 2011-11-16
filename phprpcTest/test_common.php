<?php
session_start();
define('KEEP_PHPRPC_COOKIE_IN_SESSION',true); 
include ("phprpc/phprpc_client.php");  
$client = new PHPRPC_Client('http://127.0.0.1/tflowg/service.php'); 
header("Content-type: text/html; charset=utf-8");
/*
$arg = array('leyteris','admin');
$source = $client->invoke('check_login',$arg);
$_SESSION["source"] = $source;*/