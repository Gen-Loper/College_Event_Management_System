<?php
	//Connect database
	include_once "database/connect.php";
	
	//Read session
	include 'session.php';
	$uid=$_SESSION['UserID'];
	if($uid=='' || $uid==null){
		$message="Please login to continue";
		echo "<script type='text/javascript'>alert('$message');</script>";
		header("Refresh: 0, login_register.php");
	}

	//To change password
	if (isset($_POST['change'])) {
		$passori = $_POST['original'];
		$passnew = $_POST['new'];
		$passre = $_POST['reenter'];

		$conn = mysqli_connect($servername, $username, $password, $dbname);
		

		//check password reconfirmation
		if (strcmp($passre, $passnew)!==0){
			$message="New password and re-enter password is not same. Please try again.";
			echo "<script type='text/javascript'>alert('$message');</script>";
		}
		else{
			//read original password
			$read_ori = "SELECT UserPassword FROM user_details WHERE UserID='$uid'";
			$result_read_ori = mysqli_query($conn, $read_ori);
			//compare entered original password and password in database
			if($result_read_ori){
				while($row = mysqli_fetch_array($result_read_ori, MYSQLI_ASSOC)){
					$upass=$row['UserPassword'];
					//If not same, change password fail
					if (strcmp($passori, $upass)!==0){
						$message="Original password is incorrect. Please try again.";
						echo "<script type='text/javascript'>alert('$message');</script>";
					}
					//If same, procees with change password
					else{
						$update_password = "UPDATE user_details SET UserPassword='$passre' WHERE UserID='$uid'";
						$result_update_password = mysqli_query($conn, $update_password);
						if ($result_update_password){
							$message="Change password success.";
							echo "<script type='text/javascript'>alert('$message');</script>";
						}
						else{
							$message="Fail to change password. Please try again.";
							echo "<script type='text/javascript'>alert('$message');</script>";
						}
					}
				}	
			}
		}
	}
?>
<!DOCTYPE html>
<html>
<head>
	<title></title>
	<style>
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
			margin-top: 15px;
			margin-right: 60px;
		}
		table{
			min-width: 600px;
			max-width:800px;
			margin-top:50px;
			margin-bottom:50px;
			margin-left:auto;
			margin-right:auto;
			border-radius:20px;
			background-color:#dedede;
			padding-top: 20px;
			padding-bottom: 30px;
			padding-left: 10px;
			padding-right: 10px;
			min-height: 400px;
		}
		th{
			font-size: 30px;
			text-align: center;
			padding-top: 20px;
			padding-bottom: 20px;
			text-decoration: underline;
		}
		td, input[type=password]{
			background-color:#dedede;
			padding: 5px;
			text-align: center;
			border-style: none;
			font-size: 22px;
			font-family: Times New Roman;
			width: 60%;
		}
		input[type=submit], input[type=reset]{
			padding: 10px;
			color: black;
			border: none;
			border-radius:4px;
			background-color: #2875fa;
			font-weight: 900;
			font-family: Times New Roman;
			font-size: 20px;
			text-align: center;
			width: 120px;
		}
		input[type=submit]:hover, input[type=reset]:hover{
			background-color: #0f0b3d;
			color:white;
			transition:background-color 1s;
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
	<form action="change_password.php" method="POST">
		<table>
			<tr>
				<th>Change Password</th>
			</tr>
			<tr>
				<td>
					<hr>
					<input type="password" name="original" placeholder="Original Password" style="border-bottom: 2px solid #2875fa;" required>
					<br><br>
					<input type="password" name="new" placeholder="New Password" style="border-bottom: 2px solid #2875fa;" minlength="8" maxlength="12" required>
					<br><br>
					<input type="password" name="reenter" placeholder="Re-enter New Password" style="border-bottom: 2px solid #2875fa;";  required>
					<br><br><br>
					<input type="submit" name="change" value="Save">&nbsp;&nbsp;&nbsp;&nbsp;
					<input type="reset" name="cancel" value="Cancel">
				</td>
			</tr>
		</table>
	</form>

</body>
</html>