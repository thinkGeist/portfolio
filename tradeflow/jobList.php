
<?php
session_start();
require_once'classes/Membership.php';
require_once'classes/Mysql.php';
$membership = new Membership();
$membership->confirmMember();
$conn = new mysqli(DB_SERVER, DB_USER, DB_PASSWORD, DB_NAME) or die('There was a problem 		connecting to the database');

$query = 'SELECT `PO`, `Date`, `Job Name` FROM po_1010101010 LIMIT 50';
$results = mysqli_query($conn,$query) or die(mysqli_error($conn));
	?>

	
<head>

<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Job List - Tradeflow</title>
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


<h1>Job list</h1>
<table class="hovertable" width=100%>
            <tr>
                <td width="100px">PO Number</td>
                <td>Date</td>
                <td>Job Name</td>
            </tr>
            <?php
            while($rowitem = mysqli_fetch_array($results)) {
            	echo "<tr>";
                echo "<td> <a href='jobInfo.php?jref=" . $rowitem['PO'] ."'>" . $rowitem['PO'] ."</a>" ."</td>";
                echo "<td> <a href='jobInfo.php?jref=" . $rowitem['PO'] ."'>" . $rowitem['Date'] ."</a>" ."</td>";
                echo "<td> <a href='jobInfo.php?jref=" . $rowitem['PO'] ."'>" . $rowitem['Job Name'] ."</a>" ."</td>";
            	echo "</tr>";
            }
            ?>
        </table>
        
        <input type="button"  onClick="location.href='newJob.php'" class="bluebutton" value="Add Job" />
        
                
</body>
</html>