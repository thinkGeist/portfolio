<?php
	session_start();
	require_once'classes/Membership.php';
	$membership = new Membership();
	$membership->confirmMember();
	
	require_once'classes/Mysql.php';
	$conn = new mysqli(DB_SERVER, DB_USER, DB_PASSWORD, DB_NAME) or die('There was a problem 			connecting to the database');
	
	$currentUser = $_SESSION['user'];
	
	
	$userCheck = $_GET['jref'];
	$stmt = $conn->prepare( "SELECT `class` FROM users WHERE username = ?");
	$stmt->bind_param("s", $currentUser);
	
	if($stmt->execute()){
	$stmt->bind_result($class);
	$stmt->fetch();
	
}
	if($class == 2 or $class == 3 or $class == 4){
	// Retrieve user info if class is in spec
	
	
		$stmt = $conn->prepare("SELECT `name`, `id`, `email`, `companyid`, `class` FROM users WHERE username=?");
		$stmt->bind_param("s", $userCheck);
	
		if($stmt->execute()){
			$stmt->bind_result($retName, $retId, $retEmail, $retCompanyid, $retClass);
			$stmt->fetch();
		}
		else
			echo $stmt->error;
			
		$stmt = $conn->prepare("SELECT `name` FROM companies WHERE companyid=?");
		$stmt->bind_param("i", $retCompanyid);
		
		if($stmt->execute()){
			$stmt->bind_result($retCompanyName);
			$stmt->fetch();	
		}
		else
			echo $stmt->error;
		$stmt->close();
		
	}
	
	
	
	
	
	?>
	

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<?php
echo "<title>" .$username ."'s Account - Tradeflow</title>";
?>
<link href="css/style.css" rel="stylesheet" type="text/css" />
<link href="css/menustyle.css" rel="stylesheet" type="text/css" />
<script type="type/javacript" src="js/script.js"></script>
</head>

<body>
<div id='cssmenu'>
<ul>

<li class="image">
<a href="home.php">
<img src="resources/images/tradeflow.png" width="170.5" height="45.5" alt="Tradeflow" />
</a>
</li>

   <li class='active'><a href='home.php'>Home</a></li>
   <li><a href='jobList.php'>Jobs</a>
      <ul>
         <li><a href='newJob.php'>Create Job</a></li>
         <li><a href='jobList.php'>Job List</a></li>
      </ul>
   </li>
   <li><a href='timeCard.php'>Time Card</a>
   	<ul>
    	<li><a href='timeCard.php'>View Timecard</a></li>
        <li><a href='punchCard.php'>Add Time</a></li>
    </ul>
    </li>
   <li><a href='index.php?status=loggedout'>Log out</a></li>
</ul>
</div>

<?php

echo "<h1>" .$userCheck ."'s Account</h1>";
echo "<h2>Name: " .$retName ."</h2>";
echo "<h2>Class: " .$retClass ." of " .$retCompanyName;
echo "<h2>Email: " .$retEmail ."</h2>";
echo "<h2>ID: " .$retId ."</h2>";
?>



            
</body>
</html>