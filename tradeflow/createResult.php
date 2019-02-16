
<?php
session_start();
$newpo = $_SESSION['createdpo'];

?>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Job Creation Result - Tradeflow</title>
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
<p></p>
<?php
echo '<div class="createdpo">Job Successfully Created! Your PO is: ' .$newpo . '</div>';
unset($_SESSION['createdpo']);

?>

</body>
</html>