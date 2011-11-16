<?php  
include ("../test_common.php"); 
$source = $_SESSION['source'];
if(isset($source)){
	$sd = $client->invoke('show_selfuser_info',$source);
	print_r($sd);
}
?> 