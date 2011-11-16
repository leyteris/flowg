<?php  
include ("../test_common.php");  

if(isset($source)){
	$arg2=array($source,20);
	echo $client->invoke('show_topic',$arg2);
}