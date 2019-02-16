
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
if(!empty($_POST["toolname"])){
$toolname = $_POST['toolname'];
$serial = $_POST['serial'];
$loc = $_POST['lastLoc'];
$responsible = $_POST['responsible'];
$category = $_POST['category'];
$random = rand(1000000, 9999999);
$identifier = $category + $random;

$query = "INSERT INTO `tools_1010101010` (`name`, `serial`, `lastLoc`, `responsible`, `category`, `identifier`) VALUES ('$toolname',' $serial',' $loc', '$responsible', '$category', '$identifier')";

if ($conn->query($query) === TRUE) {
    $_SESSION['createdpo'] = $conn->insert_id;
	header("Location: toolList.php");
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


<h2>Fill out as much information as possible, as it may help identify the tool later</h2>
<form id="newJobForm" method="post" class="form-newJob" role="form" action="">
<div class = "relative">
  <label>Name: </label>
  <div class = "relative">
  <input class="blueinput" name="toolname" input type="text" placeholder="Tool Name"/>
  </div>
  </div>
  <div class="relative">
  
  <label>Serial Number: </label>
  <div class="relative">
  <input type="text" class="blueinput"  name="serial">
  </div>
  </div>
  <div class="relative">
  <label>Last Location: </label>
  <div class="relative">
  <input class="blueinput" name="lastLoc" input type="text"  />
  </div>
  </div>
   <div class="relative">
  <label>Person Responsible: </label>
  <div class="relative">
  <input class="blueinput" name="responsible" input type="text"  />
  </div>
  </div>
  <div class = "relative">
  <label>Category: </label>
  <div class="relative">
  	 <select class="blueinput" name="category">
     	<option value="hand">Hand Tool</option>
        <option value="power">Power Tool</option>
        <option value="air">Air Tool</option>
        <option value="chem">Chemicals/Compounds</option>
        <option value="light">Lighting</option>
        <option value="safety">Safety</option>
        <option value="lifing">Lifting & Assistance</option>
        <option value="equipment">Heavy Equipment</option>
        
     </select>
     
</div>
</div>
  
<div class = "relative">
<form action="../www/tradeflow/upload.php" method="post" enctype="multipart/form-data">
	<div class="relative">
    <label>Picture: </label>
    <input type="file" name="fileToUpload" id="fileToUpload">
    <input type="submit" value="Upload Image" name="submit">
</form>
</div>
</div>
  <input type="submit" class="bluebutton" aligh="left"  value="Submit" />
  </form>
  
  

</body>
</html>