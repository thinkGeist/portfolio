<?php
session_start();
require_once'classes/Membership.php';
$membership = new Membership();
$membership->confirmMember();
require_once'classes/Mysql.php';
$conn = new mysqli(DB_SERVER, DB_USER, DB_PASSWORD, DB_NAME) or die('There was a problem 		connecting to the database');
?> 

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<?php

$jobnumber = $_GET['jref'];
$stmt = $conn->prepare( "SELECT `Job Name`, `Address`, `phone`, `description`, `materials` FROM po_1010101010 WHERE po = ?");
$stmt->bind_param("i", $jobnumber);
if($stmt->execute()){
	$stmt->bind_result($jobname, $address, $phone, $description, $materials);
	$stmt->fetch();
}

?>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<?php 

echo "<title>Job " .$jobnumber ." - Tradeflow</title>";
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
echo '<div class="createdpo">Job Number: ' .$jobnumber .'</div>';
echo '<div class="jobinfo2">Job Name: ' .$jobname .'</div>';
echo '<div class="jobinfo2">Phone Number: ' .$phone .'</div>';
echo '<div class="jobinfo2">Address: ' .$address .'</div>';
echo '<div class="jobinfo2">Description: ' .$description .'</div>';
echo '<div class="jobinfo2">Materials: ' .$materials .'</div>';


?>
<input type="button"  onClick="location.href='jobEdit.php?jref=<?php echo $jobnumber?>'" class="bluebutton" value="Edit Job" />
</body>
</html>