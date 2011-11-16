<?php  
include ("../test_common.php");  
$source = $_SESSION["source"];
if(isset($source)){
	$arg2=array($source,20);
	$sd = $client->invoke('delete_favorite',$arg2);
	print_r($sd);
}
?> 