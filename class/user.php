<?php

 class Users {
	 public $username = null;
	 public $password = null;
	 public $mobile = null;
	 public $restaurantname = null;
	 public $salt = "Zo4rU5Z1YyKJAASY0PT6EUg7BBYdlEhPaNLuxAwU8lqu1ElzHv0Ri7EM6irpx5w";
	 
	 public function __construct( $data ) {
			
		 if( isset( $data[0]->username ) ) $this->username = stripslashes( strip_tags( $data[0]->username ) );
		 if( isset( $data[0]->password ) ) $this->password = stripslashes( strip_tags( $data[0]->password ) );
		 if( isset( $data[0]->mobile ) ) $this->mobile = stripslashes( strip_tags( $data[0]->mobile ) );
		 if( isset( $data[0]->restaurantname ) ) $this->restaurantname = stripslashes( strip_tags( $data[0]->restaurantname ) );
	 }
	 
	 public function storeFormValues( $params ) {
		//store the parameters
		$this->__construct( $params ); 
	 }
	 
	 public function userLogin() {
		 $success = false;
		 try{
			$con = new PDO( DB_DSN, DB_USERNAME, DB_PASSWORD ); 
			$con->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );
			$sql = "SELECT * FROM users WHERE username = '".$this->username."' AND password = '".hash("sha256", $this->password . $this->salt)."' LIMIT 1";
			//echo $sql;
			$stmt = $con->prepare( $sql );
			//$stmt->bindValue( "username", $this->username, PDO::PARAM_STR );
			//$stmt->bindValue( "password", hash("sha256", $this->password . $this->salt), PDO::PARAM_STR );
			//echo hash("sha256", $this->password . $this->salt);
			//echo $this->username;
			
			$stmt->execute();
			$total = $stmt->rowCount();
			
			
			if( $total==1 ) {
				$success = true;
			}
			
			$con = null;
			return $success;
		 }catch (PDOException $e) {
			 echo $e->getMessage();
			 return $success;
		 }
	 }
	 
	 public function register() {
		$correct = false;
			try {
				$con = new PDO( DB_DSN, DB_USERNAME, DB_PASSWORD );
				$con->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );
				$sql = "INSERT INTO users(username, password,mobile,restName) VALUES(:username, :password, :mobile, :restName)";
				
				$stmt = $con->prepare( $sql );
				$stmt->bindValue( "username", $this->username, PDO::PARAM_STR );
				$stmt->bindValue( "mobile", $this->mobile, PDO::PARAM_STR );
				$stmt->bindValue( "restName", $this->restaurantname, PDO::PARAM_STR );
				$stmt->bindValue( "password", hash("sha256", $this->password . $this->salt), PDO::PARAM_STR );
				$stmt->execute();
				return 1;
			}catch( PDOException $e ) {
				
				return -1;
			}
	 }
	 
 }
 
?>