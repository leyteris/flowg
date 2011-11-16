<?php  
include ("../test_common.php"); 
$source = $_SESSION['source'];
if(isset($source)){
	$client->invoke('followers',$source);
	//$client->getOutput();
	$d=$client->getWarning();
	if(isset($d)){
		print_r($sd->Message);
	}else{
		echo 'ok';
	}
}
?> 