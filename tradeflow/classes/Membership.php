<?php
require 'Mysql.php';
class Membership {
	
	function validateUser($un, $pwd) {
		$mysql = New Mysql();
		$ensureCredentials = $mysql->verifyUserAndPass($un, md5($pwd));
		
		if(SensureCredentials){
			$_SESSION['status'] = 'authorized';
			return true;
		}
		else return 'Please enter a correct username and password';
	}
	
	function logUserOut(){
		session_destroy();
	}
	
	function confirmMember(){
		if($_SESSION['status'] == 'authorized'){
			
		}
		
		else
			header('location: index.php');
			
	}
	function getId($un){
		$conn = new mysqli(DB_SERVER, DB_USER, DB_PASSWORD, DB_NAME) or die('There was a problem 			connecting to the database');
		$stmt = $conn->prepare( "SELECT id  FROM users WHERE username = ?");
		$stmt->bind_param("s", $un);
		if ($stmt->execute()){
			$stmt->bind_result($id);
			$stmt->fetch();
			
			return $id;
		}
		else
			echo $stmt->error;
	}
	
	
}
	