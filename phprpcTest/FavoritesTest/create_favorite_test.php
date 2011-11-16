<?php  
include ("../test_common.php");  
$source = $_SESSION["source"];
if(isset($source)){
	$arg2=array($source,288);
	$sd = $client->invoke('create_favorite',$arg2);
	print_r($sd);
}
?> 