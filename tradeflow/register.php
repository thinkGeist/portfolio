<?php
session_start();
require_once 'classes/Membership.php';
require_once 'classes/Mysql.php';
$conn = new mysqli(DB_SERVER, DB_USER, DB_PASSWORD, DB_NAME) or die('There was a problem 		connecting to the database');
$membership = new Membership();
$membership->confirmMember();


if($_POST && !empty($_POST['username']) && !empty($_POST['companyid']) && !empty($_POST['email'])       && !empty($_POST['password'])){
	$username = $_POST['username'];
	$name = $_POST['name'];
	$email = $_POST['email'];
	$companyid = $_POST['companyid'];
	$register = TRUE;
	// Username Check
	$stmt = $conn->prepare("SELECT username FROM users WHERE username=?");
	$stmt->bind_param("s", $username);
    if($stmt->execute()){
    	$stmt->store_result();
     	$user_check= "";         
     	$stmt->bind_result($user_check);
     	$stmt->fetch();

     	if ($stmt->num_rows == 1){
			header("register.php");
     		echo "That username already exists.";
			$register = FALSE;
		}
		$stmt->close();
	}
	
	//Email Check
	$stmt = $conn->prepare("SELECT email FROM users WHERE email=?");
	$stmt->bind_param("s", $email);
    if($stmt->execute()){
    	$stmt->store_result();
     	$user_check= "";         
     	$stmt->bind_result($user_check);
     	$stmt->fetch();

     	if ($stmt->num_rows == 1){
			header("register.php");
     		echo "That email already exists.";
			$register = FALSE;
		}
		$stmt->close();
	}
	
	//Company ID Check
	$stmt = $conn->prepare("SELECT companyid FROM companies WHERE companyid=?");
	$stmt->bind_param("s", $companyid);
	if($stmt->execute()){
		$stmt->store_result();
		
		if($stmt->num_rows != 1){
			header("register.php");
			echo "That company does not exist!";
			$register = FALSE;
		}
		$stmt->close();
	}
			
	
	//Register
	if($register == TRUE){
	$stmt = $conn->prepare("INSERT INTO users (username, name, email, companyid, password) VALUES (?, ?, ?, ?, ?)");
	$stmt->bind_param("sssis", $username, $name, $email, $companyid, md5($password));
	if($stmt->execute()){
		echo "User successfully created, you will be receiving an email shortly to confirm user";
	}
	else
		echo "Unidentified error when trying to create user";

}
}



?>


<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Register - Tradeflow</title>
<link href="css/style.css" rel="stylesheet" type="text/css" />
<link href="css/menustyle.css" rel="stylesheet" type="text/css" />
<script type="type/javacript" src="js/script.js"></script>
</head>

<body>
<div id='cssmenu'>
<ul>
   <li><a href='home.php'>Home</a></li>
   <li><a href='jobList.php'>Jobs</a>
      <ul>
         <li><a href='newJob.php'>Create Job</a></li>
         <li class='active'><a href='jobList.php'>Job List</a></li>
      </ul>
   </li>
   <li><a href='../www/tradeflow/pricing.php'>Pricing</a></li>
   <li><a href='index.php?status=loggedout'>Log out</a></li>
</ul>
</div>
<div class="center">
  <h1 class="title">Register</h1>
<form id="register-form" method="post" class="form-register" role="form" action="">
<div class="blockcenter">
	<input class="blueinput" name="username" input type="text" placeholder="User ID" />
    </div>
    <div class="blockcenter">
	<input class="blueinput" name="name" input type="text" placeholder="Employee Name" />
    </div>
    <div class="blockcenter">
    <input class="blueinput" name="companyid" input type="text" placeholder="1234567890"/>
    </div>
    <div class="blockcenter">
    <input class="blueinput" name="email" input type="email" placeholder="someone@somewhere.com"/>
    </div>
    <div class="blockcenter">
    <input class="blueinput" name="password" input type="password" placeholder="Password" />
    </div>
    <div class="blockcenter">
		<input type="submit" class="bluebutton" aligh="left"  value="Submit" />
    </div>

    </form>
</div>
</body>
</html>