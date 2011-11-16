<?php  
include ("../test_common.php");  
$source = $_SESSION["source"];
if(isset($source)){
	$arg2=array($source,1,20);
	$sd = $client->invoke('home_timeline',$arg2);
	print_r($sd);
	
	$arg2=array($source,2);
	$sd = $client->invoke('user_timeline',$arg2);
	print_r($sd);
}
?> 