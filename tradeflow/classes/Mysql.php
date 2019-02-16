<?php
require_once '../../www/tradeflow/classes/includes/constants.php';

class Mysql{
	private $conn;
	function __construct() {
		$this->conn = new mysqli(DB_SERVER, DB_USER, DB_PASSWORD, DB_NAME) or die('There was a problem 		connecting to the database');
	}
	
	function verifyUserAndPass($un, $pwd){
		
		$query = 'SELECT * FROM users WHERE username = ? AND password = ? LIMIT 1';
		$stmt = $this->conn->prepare('SELECT * FROM users WHERE username = ? AND password = ? LIMIT 1');
		 
			$stmt->bind_param('ss', $un, $pwd);
			if($stmt->execute()){
			
			if($stmt->fetch()){
				$stmt->close();
				return true;
			}
			else
				return false;
			}
	}
}
	