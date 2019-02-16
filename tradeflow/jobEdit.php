
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
$stmt = $conn->prepare( "SELECT `Job Name`, `Address`, `phone`, `description`, `materials`, `date` FROM po_1010101010 WHERE po = ?");
$stmt->bind_param("i", $jobnumber);
if($stmt->execute()){
	$stmt->bind_result($jobname, $address, $phone, $description, $materials, $date);
	$stmt->fetch();
	$stmt->store_result();
}

?>



<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Edit Job - Tradeflow</title>
<link href="css/style.css" rel="stylesheet" type="text/css" />
  <link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
  <link href="css/style.css" rel="stylesheet" type="text/css" />
<link href="css/menustyle.css" rel="stylesheet" type="text/css" />
  <script src="//code.jquery.com/jquery-1.10.2.js"></script>
  <script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
  <script type="type/javacript" src="js/main.js"></script>
  <link rel="stylesheet" href="/resources/demos/style.css">
  <script>
  $(function() {
    $( "#datepicker" ).datepicker();
  });
  </script>
  

</head>

<body>
<?php
if(!empty($_POST["jobname"]) && !empty($_POST["date"])){
$jobname = $_POST['jobname'];
$date = $_POST['date'];
$address = $_POST['address'];
$phone = $_POST['phone'];
$description = $_POST['description'];
$materials = $_POST['materials'];
$completed = $_POST['completed'];
$query = 'UPDATE `po_1010101010` SET `Job Name` = "'.$jobname.'" , Date = "'.$date.'" , Address = "'.$address.'" , phone = "'.$phone.'" , description = "'.$description.'" , materials = "'.$materials.'" WHERE po = ' .$jobnumber;

if ($conn->query($query) === TRUE) {
	session_write_close();
	
}
else {
	echo "Error editing Job: " .$conn->error;
}

}

?>
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


<h2>You are currently editing <?php $jobnumber?>, be careful as changes you make will change the job entirely,</h2>
<h3>DELETING AN ENTIRE FIELD WILL DELETE ALL THAT INFO FROM THE SYSTEM</h3>
<form id="newJobForm" method="post" class="form-newJob" role="form" action="">
<div class = "relative">
  <label>Job Name: </label>
  <div class = "relative">
  <input class="blueinput" name="jobname" input type="text" value="<?php echo $jobname?>"/>
  </div>
  </div>
  <div class="relative">
  
  <label>Date: </label>
  <div class="relative">
  <input type="text" class="blueinput" id="datepicker" name="date" value="<?php echo $date?>">
  </div>
  </div>
  <div class="relative">
  <label>Address: </label>
  <div class="relative">
  <input class="blueinput" name="address" input type="text" value="<?php echo $address?>" />
  </div>
  </div>
   <div class="relative">
  <label>Customer Phone: </label>
  <div class="relative">
  <input class="blueinput" name="phone" input type="text" value="<?php echo $phone?>" />
  </div>
  </div>
  <div class = "relative">
  <label>Job Description: </label>
  <div class="relative">
  	 <textarea class="blueinput" name="description" rows="4" cols="50" wrap="hard" value="<?php echo $description?>">
</textarea> 
</div>
</div>
  <div class = "relative">
  <label>Materials Used: </label>
  <div class="relative">
  	 <textarea class="blueinput"  name="materials" rows="4" cols="50" wrap="hard" value="<?php echo $materials?>">
</textarea> 
</div>
</div>

<label>Job Completed? </label>
<input type="radio"  name="completed" value="male" checked>Yes
<input type="radio"  name="completed" value="female">No

<div class = "relative">
<!--<form action="upload.php" method="post" enctype="multipart/form-data">
	<div class="relative">
    <label>Picture: </label>
    <input type="file" name="fileToUpload" id="fileToUpload">
    <input type="submit" value="Upload Image" name="submit">
</form>-->
</div>
</div>
  <input type="submit" class="bluebutton" aligh="left"  value="Submit" />
  </form>
  
  

</body>
</html>