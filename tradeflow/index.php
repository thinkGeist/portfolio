<?php
session_start();
require_once 'classes/Membership.php';
$membership = new Membership();


//If user clicks log out link
if(isset($_GET['status']) && $_GET['status'] == 'loggedout'){
	$membership->logUserOut();
}

//Did the user enter user/pass
if($_POST && !empty($_POST['username']) && !empty($_POST['password'])){
	$response = $membership->validateUser($_POST['username'], $_POST['password']);
	
}
	
	
	?>
	

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta name="google-site-verification" content="MA2ROmwMr4_aFhyFlPa2F3oFzSffeRgux14AgrAQFy8" />
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Home - Tradeflow</title>
<link href="css/style.css" rel="stylesheet" type="text/css" />
<script type="type/javacript" src="js/main.js"></script>

</head>

<body>
<div class="wrapper">


<div class="center">
<img src="resources/images/tradeflow.png" class="titleimage" alt="Tradeflow" width="682" height="182" />
<div class="loginframe">
<form id="login-form" method="post" class="form-signin" role="form" action="">
	<div class="blockcenter">
	  <input class="blueinput" name="username" input type="text" placeholder="User ID" />
    </div>
    <div class="blockcenter">
    <input class="blueinput" name="password" input type="password" placeholder="Password" />
    </div>
	<div class="blockcenter">
		<input type="submit" class="bluebutton"  value="Login" />
    </div>
	</form>
    <div class="blockcenter">
	<input type="button" onClick="location.href='register.php'" class="bluebutton" value="Register" />
	</div>
    
    <?php
	if(isset($response))
		echo "<h4 class='errorhome'>"  . $response . "</h4>"; 
        if($response == true){
			$_SESSION['user'] = $_POST['username'];
			
			header('location: home.php');
		}
		?>
        
</div>
</div>
</div>
<div class="footer">
Copyright Tradeflow 2015
</div>
</body>
</html>