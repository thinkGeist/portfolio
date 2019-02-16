
<?php
session_start();
require_once'classes/Membership.php';
$membership = new Membership();
$membership->confirmMember();
require_once'classes/Mysql.php';
$conn = new mysqli(DB_SERVER, DB_USER, DB_PASSWORD, DB_NAME) or die('There was a problem 		connecting to the database');
?>



<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>New Job - Tradeflow</title>
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
$po = $_POST['po'];
$jobname = $_POST['jobname'];
$date = $_POST['date'];
$address = $_POST['address'];
$phone = $_POST['phone'];
$description = $_POST['description'];
$materials = $_POST['materials'];
$completed = $_POST['completed'];
$query = "INSERT INTO `po_1010101010` (`PO`, `Job Name`, `Date`, `Address`, `phone`, `description`, `materials`, `completed`) VALUES ('$po', '$jobname',' $date',' $address', '$phone', '$description', '$materials', '$completed')";

if ($conn->query($query) === TRUE) {
    $_SESSION['createdpo'] = $po;
	header("Location: createResult.php");
	session_write_close();
	
}
else {
	echo "Error creating new Job: " .$conn->error;
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


<h2>This Job creation is for power users ONLY. It allows you to enter whatever PO you want regardless of order.</h2>
<form id="newJobForm" method="post" class="form-newJob" role="form" action="">
<div class = "relative">
  <label>PO: </label>
  <div class = "relative">
  <input class="blueinput" name="po" input type="text" placeholder="Job Name"/>
  </div>
  <label>Job Name: </label>
  <div class = "relative">
  <input class="blueinput" name="jobname" input type="text" placeholder="Job Name"/>
  </div>
  </div>
  <div class="relative">
  
  <label>Date: </label>
  <div class="relative">
  <input type="text" class="blueinput" id="datepicker" name="date">
  </div>
  </div>
  <div class="relative">
  <label>Address: </label>
  <div class="relative">
  <input class="blueinput" name="address" input type="text" placeholder="Address" />
  </div>
  </div>
   <div class="relative">
  <label>Customer Phone: </label>
  <div class="relative">
  <input class="blueinput" name="phone" input type="text" placeholder="111-222-3333" />
  </div>
  </div>
  <div class = "relative">
  <label>Job Description: </label>
  <div class="relative">
  	 <textarea class="blueinput" name="description" rows="4" cols="50" wrap="hard" placeholder="Job Description, preferably seperated by commas.">
</textarea> 
</div>
</div>
  <div class = "relative">
  <label>Materials Used: </label>
  <div class="relative">
  	 <textarea class="blueinput"  name="materials" rows="4" cols="50" wrap="hard" placeholder="Materials used, seperated by commas.">
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