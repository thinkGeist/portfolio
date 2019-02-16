<?php
	session_start();
	require_once'classes/Membership.php';
	$membership = new Membership();
	
	$membership->confirmMember();
	
	?>
	

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Timecard - Tradeflow</title>
<link href="css/style.css" rel="stylesheet" type="text/css" />
<link href="css/menustyle.css" rel="stylesheet" type="text/css" />
<link href="css/clndr.css" rel="stylesheet" type="text/css" />

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

<div class="container">
    <div class="cal1">
    </div>
   
   


  <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
  <script src="http://cdnjs.cloudflare.com/ajax/libs/underscore.js/1.5.2/underscore-min.js"></script>
  <script src= "js/Moment.js"></script>

  <script src="js/Clndr.js"></script>
  <script src="js/site.js"></script>


  <!-- Enable live-reloading in the browser without an extension -->
  <script src="http://localhost:35729/livereload.js"></script>
            
</body>
</html>