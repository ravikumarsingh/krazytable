<?php 
	include_once("config.php");
	$json = file_get_contents('php://input');
	

	$obj = json_decode($json);

	$usr = new Users($obj);
	$usr->storeFormValues( $obj );
	
	if( $usr->userLogin() ) {
		$response=array('status'=>1,'description'=>"Successful");
	} else {
		$response=array('status'=>0,'description'=>"Fail");
	}
	echo json_encode($response);

?>