<?php  
include ("../test_common.php"); 
$source = $_SESSION['source'];
if(isset($source)){
	$arg2 = array($source,2);
	$sd = $client->invoke('show_user_info',$arg2);
	print_r($sd);
}
?> 