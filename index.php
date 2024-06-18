<?php
	//Connect database
	include "database/connect.php";
	
	//Read session
	include 'session.php';

	//Read button script
	include "top_button.html";
?>

</!DOCTYPE html>
<html>
<head>
	<title>HSIT Events</title>
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

		.text,h1{
		font-family: system-ui, -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Oxygen, Ubuntu, Cantarell, 'Open Sans', 'Helvetica Neue', sans-serif;
		font-weight: 800;
		font-size:400%;
		background: linear-gradient(to right,rgb(255, 0, 153),rgb(0, 183, 255),rgb(0, 255, 204));
		background-size: 200% auto;
		-webkit-background-clip: text;
		color: transparent;
		animation: gradient 3s linear infinite;
	}
	@keyframes gradient{
		0%{
			background-position: 0% 75%;
		}
		50%{
			background-position: 100% 50%;
		}
		100%{
			background-position: 0% 100%;
		}
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
		.top{
			font-size: 34px;
			width:auto;
			display:inline block;
			font-family: Helvetica;
			text-align: center;
			align-items:center;
			background-color:white;
		}
		form{
			margin-left: 60px;
			margin-top: 15px;
			margin-right: 60px;
		}
		input[type=submit]{
			padding: 12px;
			color: white;
			border: none;
			border-radius:6px;
			background-color:  #2875fa;
			font-weight: 900;
			font-family: Times New Roman;
			font-size: 16px;
			text-align: center;
			width: auto;
		}
		input[type=submit]:hover{
			background-color:#0f0b3d;
			transition:background-color 1s;
		}
		table{
			text-align:justify;
			border-bottom:line;
		}
		.event_name{
			font-family: Times New Roman;
			border-style: none;
			width:100%;
			background-color:#5c5c5c;
			font-size: 40px;
			font-weight:bold;
			color:#edeff2;
			margin-top: 100px;
		}
		table td{
			color:black;
			font-weight:bold;

		}
		.content{
			font-size:25px;
		}
		footer{
			background-color:white;
			color:black;
			left: 0;
			bottom: 0;
			width: 100%;
			z-index: 1;
		}
		.copy_rights{
			display: grid;
			height:5px;
			top:10px;
			justify-content;center;
			text-align:center;
			margin-top:60px;
			padding-top:10px;
		}
		.grid{
			display:grid;

		}
		footer tr{
			width:auto;
			margin-left:15px;
			margin-top:0px;
			color:black;
		}
		.table2 th{
			color: #ff1a1a;
			font-size:20px;
		}

		.table2{
			width: 400px;
			margin-left:25px;
			text-align:left;
		}
		.container{
			text-align:right;
			padding-right:15px;

		}
		.email:hover{
			cursor:pointer;
		}
		.b{
			color: #ff1a1a;
			margin-right:15px;
		}

		.guide{
			color:#ff1a1a;
			font-family: 'Franklin Gothic Medium', 'Arial Narrow', Arial, sans-serif;
			font-size:23px;
			margin-left:25px;
			margin-top:10px;
		}
		nav{
			background-color:white;
			height:4px;
		}

	</style>
</head>
<body>
	<nav>
		<button onclick="topFunction()" id="myBtn" title="Go to top"></button>
	</nav>
	<div>
	<div>
	<div class="top">
		<h1>HSIT EVENTS</h1>
	</div>
	<!--Search event form-->
	<div class="search" style="text-align: center">
		<form action="event_detail.php" method="POST" >
			<input type="text" size="40" name="searchevent" placeholder="Enter event name to search event" style="font-size: 16px;padding: 10px" />
			<input type="submit" name="search" value="Search"/>
		</form>
	</div>
	<!--Display all event area-->
	<div class="content" align="center">
		<?php
			$conn = mysqli_connect($servername, $username, $password, $dbname);

			//Read all event
			$read_DB = "SELECT * FROM event_details ORDER BY EventDate DESC";
			$result = mysqli_query($conn, $read_DB);
			
			//Display all result
			if($result){
    			while($row = mysqli_fetch_array($result, MYSQLI_ASSOC)){
    				echo "<form action='event_detail.php' method='POST'><table>";
        			echo "<tr><td><input class ='event_name'  type='text' name='eventname' value='".$row['EventName']."' size=65 readonly></td></tr>";
        			echo "<tr><td><span  style='font-size:20px'><hr><br>". $row['EventDescription']."</td></tr>";
        			echo "<tr><td><br></td></tr>";
        			echo "<tr><td style='text-align:center'><input type='submit' name='more_detail' value='More Details'/></td></tr>";
        			echo "<tr><td><br></td></tr>";
        			echo "</table></form><br>";
    			}
			}
		?>
	</div>
	<footer>
			<div class="developers">
					<table class="table2" cellspacing="2px">
						<tr>
						<th>Developers</th>
						<th>Contact Details</th>
						</tr>

						<tr>
						<td style="color:black">Aniket &nbsp; (2HN21CS005)</td>
						<td style="color:black"><u>6363095078</u></td>
						</tr>

						<tr>
						<td style="color:black">Ekanth &nbsp; (2HN21CS012)</td>
						<td style="color:black"><u>7619233995</u></td>
						</tr>

						<tr>
						<td style="color:black">Ganesh &nbsp; (2HN22CS402)</td>
						<td style="color:black"><u>6361335570</u></td>
						</tr>

						<tr>
						<td style="color:black">Kartik &nbsp; (2HN22CS404)</td>
						<td style="color:black"><u>9535435754</u></td>
						</tr>
			</div>

			<div class="copy_rights">
				&copy; Copyright 2024 are reserved by:HSIT
			</div>

				<div class="guide">
					Guide :Prof S V Manjaragi
				</div>

			<div class="container">
			<div class="email">
			<span class="b" href="https://hsit.ac.in/" style="font-size:18px">
				principal@hsit.ac.in
		</span>
			</div>
	</footer>

</body>
</html>