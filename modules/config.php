<?php
    //set off all error for security purposes
	error_reporting(E_ALL);
	

	//define some contstant
    define( "DB_DSN", "mysql:host=localhost;dbname=krazytable" );
    define( "DB_USERNAME", "krazytable" );
    define( "DB_PASSWORD", "12345678" );
	define( "CLS_PATH", "class" );
	
	//include the classes
	include_once( CLS_PATH . "/user.php" );
	

?>