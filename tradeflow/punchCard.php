<?php
	session_start();
	require_once 'classes/Membership.php';
	require_once 'classes/Mysql.php';
	$conn = new mysqli(DB_SERVER, DB_USER, DB_PASSWORD, DB_NAME) or die('There was a problem 			connecting to the database');
	$membership = new Membership();
	
	$membership->confirmMember();
	// Get the session ID from username
	$id = $membership->getId($_SESSION['user']);
	date_default_timezone_set('Canada/Central');
	
	
	
	if($_POST['punchout']){
		echo "attempted out";
		// Punch user out of current job and insert value into timesheet
		$stmt = $conn->prepare("SELECT PO, punchInTime FROM punch_1010101010 WHERE EmployeeID=?");
		$stmt->bind_param("i", $id);
		if($stmt->execute()){
			$stmt->store_result();
			$stmt->bind_result($currentpo, $inTime);
			$stmt->fetch();
			$stmt->close();
			$stmt = $conn->prepare("INSERT INTO ts_1010101010 (EmployeeID, PO, Date, Time) VALUES (?, ?, DATE(?), TIMESTAMPDIFF(MINUTE,?,NOW())-60)"); 
			$stmt->bind_param("iiss", $id, $currentpo, $inTime, $inTime);
			if($stmt->execute()){
				
				$stmt = $conn->prepare("DELETE FROM punch_1010101010 WHERE EmployeeID=?");
				$stmt->bind_param("i", $id);
				if ($stmt->execute()){
						echo "Successfully punched out and recorded into timesheet!";
				}
				else
					echo "Did not successfully punch out and record";
			}
			else
				echo "Error punching out of job!";
				echo $stmt->error;
		}
		else
			echo "Error attempting to retrieve punch in time!";
		

		
	}
	
 if($_POST['punchin'] && !empty($_POST['ponumber'])){
		// Punch user in to job number at given location and current time
		$ponumber = $_POST['ponumber'];
		
		// Check if PO number is currently registered as a job.
		$stmt = $conn->prepare("SELECT `PO` FROM po_1010101010 WHERE `PO`=?");
		$stmt->bind_param("i", $ponumber);
		if($stmt->execute()){
			// Check number of rows	
			$stmt->store_result();
			if($stmt->num_rows != 0){
				
		
				$nowTime = date("Y-m-d H:i:s");  
				$stmt = $conn->prepare("INSERT INTO punch_1010101010 (EmployeeID, po, punchInTime) VALUES (?, ?, ?)");
				$stmt->bind_param("iis", $id, $ponumber, $nowTime);
				if($stmt->execute()){
					echo "Successfully punched in to: " ;
					echo $ponumber;
				}
				else
					echo $stmt->error;
			}
			else{
				echo '<h2>'; echo $ponumber; echo ' is not a job in the database, please create the job before punching into it';
			}
		}
 	}
	?>
	

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Timecard - Tradeflow</title>
<link href="css/style.css" rel="stylesheet" type="text/css" />
<link href="css/menustyle.css" rel="stylesheet" type="text/css" />
<script type="type/javacript" src="js/script.js"></script>

</head>
<!--Dealing with time zone checking-->


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
	echo $id;
	$stmt = $conn->prepare("SELECT `EmployeeID` FROM punch_1010101010 WHERE EmployeeID=?");
	$stmt->bind_param("i", $id);
	if ($stmt->execute()){
		$stmt->store_result();
		
		
		if($stmt->num_rows != 0){
			$punchedIn = 1;
			$stmt = $conn->prepare("SELECT `PO`, `punchInTime` FROM punch_1010101010 WHERE EmployeeID=?");
			
			$stmt->bind_param("i", $id);
			if($stmt->execute()){
				$stmt->bind_result($currentpo, $punchInTime);
				$stmt->fetch();
				$punchTime = strtotime($punchInTime);
				echo '<div class="punchBlock">';
				echo '<h2>Currently punched in to:'; echo $currentpo; echo'</h2>';
				echo '<br/>';
				echo '<h2>Since: '; echo date('l F j g:i a', $punchTime); echo'</h2>'; 
				 echo '<h2>Current time: '; echo date('l F j g:i a'); echo '</h2>';
				 echo '<br/>';
				echo '<form id="punchOutForm" method="post" class="form-punchOut" role="form" action="">
				<input type="submit" class="bluebutton" aligh="left"  value="Punch Out" name="punchout" />
				</form></div>';
			}
			else
				echo "Unknown error occured retrieving currently punched in job!";
		}
		else{
			echo '<form id="punchInForm" method="post" class="form-punchIn" role="form" action="">
		<div class="blockcenter">
		<input class="blueinput" name="ponumber" input type="text" placeholder="Job PO Number"/>
    
   	 <input type="submit" class="bluebutton" aligh="left"  value="Punch In" name="punchin"/>
   	 </div></form>';

		}
	}
		?>




            
</body>
</html>