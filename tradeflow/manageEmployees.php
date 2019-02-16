<?php
	session_start();
	require_once'classes/Membership.php';
	$membership = new Membership();
	$membership->confirmMember();
	
	require_once'classes/Mysql.php';
	$conn = new mysqli(DB_SERVER, DB_USER, DB_PASSWORD, DB_NAME) or die('There was a problem 		connecting to the database');

	$query = 'SELECT `username`, `name`, `id`, `class`, `email` FROM users WHERE companyid="1010101010"';
	$results = mysqli_query($conn,$query) or die(mysqli_error($conn));
	
	
	
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
<title>Manage Employee's - TradeFlow</title>
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
<table class="hovertable" width=100%>
            <tr>
                <td width="100px">Username</td>
                <td>ID</td>
                <td>Name</td>
                <td>Class</td>
                <td>Email</td>
            </tr>
            <?php
            while($rowitem = mysqli_fetch_array($results)) {
            	echo "<tr>";
                echo "<td> <a href='userInfo.php?jref=" . $rowitem['id'] ."'>" . $rowitem['username'] ."</a>" ."</td>";
                echo "<td> <a href='userInfo.php?jref=" . $rowitem['id'] ."'>" . $rowitem['id'] ."</a>" ."</td>";
                echo "<td> <a href='userInfo.php?jref=" . $rowitem['id'] ."'>" . $rowitem['name'] ."</a>" ."</td>";
				echo "<td> <a href='userInfo.php?jref=" . $rowitem['id'] ."'>" . $rowitem['class'] ."</a>" ."</td>";
				echo "<td> <a href='userInfo.php?jref=" . $rowitem['id'] ."'>" . $rowitem['email'] ."</a>" ."</td>";
            	echo "</tr>";
            }
            ?>
        </table>
        


            
</body>
</html>