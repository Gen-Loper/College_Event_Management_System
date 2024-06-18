<?php
	//Connect database
	include "database/connect.php";

	//Read session
	include 'session.php';
	$uid=$_SESSION['UserID'];
	if($uid=='' || $uid==null){
		$message="Please login to continue";
		echo "<script type='text/javascript'>alert('$message');</script>";
		header("Refresh: 0, login_register.php");
	}
?>

<!DOCTYPE html>
<html>
<head>	
	<title>Events - My Booking</title>
	<style type="text/css">
		body{
			background-color:#cbccd6;
			z-index: 2;
		}
		.Dark{
			background-color: black;
			color:Black;
		}
		.Light{
			background-color:rgb(0, 0, 93);
			color:rgb(255, 255, 255);
		}
		a:hover{
			font-size: 24px;
			background-color:#e3917d;
			transition:background-color 1s;
			border-radius:5px;
		}
		a{
			color:black;
			margin-right:5px;
			margin-left:5px;
			padding:5px 4px 5px 5px;
			
		}
		form{
			margin-left: 60px;
			margin-top: 50px;
			margin-right: 60px;
		}
		table{
			max-width: 1200px;
			margin-bottom:50px;
			margin-left:auto;
			margin-right:auto;
			margin-top:50px;
			background-color:#dedede;
			border-radius:20px;
			text-align:center;
			padding-top: 10px;
			padding-left: 20px;
			padding-right: 20px;
		}
		th{
			font-family:bold;
			border:1px solid;
			font-size: 20px;
			text-align: center;
			padding: 5px 10px;
		}
		td{
			border:1px solid black;
			font-size: 18px;
			font-family: Times New Roman;
			padding: 5px 5px;
		}
		div{
			margin: auto;
			padding-bottom: 5px;
			min-width: 50%;
			max-width: 80%;
			background-color:#dedede;
		}
		hr{
			border-top: 5px dotted grey;
			border-bottom: none;
			border-left: none;
			border-right: none;
			width: 95%;
			padding-top: 10px
		}
	</style>
</head>
<body>
	<div id="view" align="center">
		<p style="padding-top: 30px; text-decoration: underline; font-size: 30px;font-weight: 900">My Booking</p>
		<hr>
		<table align="center" cellpadding="6px" cellspacing="6px">
			<tr>
				<th>No.</th>
				<th>Booking<br>Date & Time</th>
				<th>Event Name</th>
				<th>Event Date</th>
				<th>Event Time</th>
				<th>Venue</th>
			</tr>
			<!--Get all booking record of hte user-->
			<?php
				
				$count=0;
				$conn = mysqli_connect($servername, $username, $password, $dbname);
				//Read user booking detail
				$read_user_booking = "SELECT * FROM booking_details WHERE UserID='$uid'";
				$result_read_user_booking = mysqli_query($conn, $read_user_booking);
				if ($result_read_user_booking){
					while($row = mysqli_fetch_array($result_read_user_booking, MYSQLI_ASSOC)){
						$eid=$row['EventID'];
						$count=$count+1;
						echo "<tr>";
						echo "<td>".$count."</td>";
						echo "<td>".$row['BookingTimeStamp']."</td>";
						//Read event detail
						$read_event_detail = "SELECT * FROM event_details WHERE EventID='$eid'";
						$result_read_event_detail = mysqli_query($conn, $read_event_detail);
						if ($result_read_event_detail){
							while($row1 = mysqli_fetch_array($result_read_event_detail, MYSQLI_ASSOC)){
								$vid=$row1['VenueID'];
								echo "<td>".$row1['EventName']."</td>";
								echo "<td>".$row1['EventDate']."</td>";
								echo "<td>".$row1['EventTime']."</td>";
								//Read venue detail
								$read_venue_detail = "SELECT * FROM venue_details WHERE VenueID='$vid'";
								$result_read_venue_detail = mysqli_query($conn, $read_venue_detail);
								if ($result_read_event_detail){
									while($row2 = mysqli_fetch_array($result_read_venue_detail, MYSQLI_ASSOC)){
										echo "<td>".$row2['VenueName']."</td>";
									}
								}
							}
						}
						echo "</tr>";
					}
				}
			?>
		</table>
	</div>
</body>
</html>