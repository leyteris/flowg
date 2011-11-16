<?php
include ("../test_common.php"); 
$source = $_SESSION["source"];
if(isset($source)){
	$arg2 = array($source,'asdhasjkdah阿苏丹哈速度快就阿海隧道客机哈萨克');
	$sd = $client->invoke('update',$arg2);
	print_r($sd);
}