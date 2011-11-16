<?php  
include ("test_common.php");  

$arg = array('leyteris','admin');
$source = $client->invoke('check_login',$arg);
$_SESSION["source"] = $source;
/*if(isset($source)){
	$arg2=array($source,20);
	echo $client->invoke('show_topic',$arg2);
}*/