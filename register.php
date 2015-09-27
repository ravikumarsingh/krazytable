<?php 
include_once("config.php"); 	
$json = file_get_contents('php://input');

$obj = json_decode($json);
if($obj[0]->username=="")
{
	$response=array('status'=>0,'description'=>"Mendatory values not pprovided");
}
 else {
	$usr = new Users($obj);
	$usr->storeFormValues( $obj );
	$res = $usr->register($obj);	
	if($res==1)
	{
		$response=array('status'=>1,'description'=>"Successful");
	}
	else if($res==-1)
	{
		$response=array('status'=>0,'description'=>"Email already registered");
	}
	else if($res == -2)
	{
			$response=array('status'=>0,'description'=>"Mobile Number already registered");
	}
	echo json_encode($response);
}
?>