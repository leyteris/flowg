<?php  
include ("../test_common.php");  
$source = $_SESSION["source"];
if(isset($source)){
	$arg2=array($source);
	$sd = $client->invoke('selfuser_timeline',$arg2);
	print_r($sd);
}
?> 