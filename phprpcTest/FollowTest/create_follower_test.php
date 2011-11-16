<?php  
include ("../test_common.php");  
$source = $_SESSION["source"];
if(isset($source)){
	$arg2=array($source,2);
	$sd = $client->invoke('create_follower',$arg2);
	print_r($sd);
}
?> 