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

	//Read button script
	include "top_button.html";

	if(isset($_POST['editpicture'])){
		//mySQL (Object-oriented)
		$conn = new mysqli($servername, $username, $password, $dbname);
		//get uploaded image
		$newpicture=addslashes(file_get_contents($_FILES['picture']['tmp_name']));
		//get uploaded image name
		$newpicture_name=$_FILES['picture']['name'];
		if($newpicture==false){
			echo "<script>alert('Empty field. No update made.')</script>";		
		}
		else{
			$update_picture = "UPDATE user_details SET UserImage='".$newpicture."' WHERE UserID='$uid'";
			$result_update_picture = $conn->query($update_picture); 
			$update_picture_name = "UPDATE user_details SET UserImageName='".$newpicture_name."' WHERE UserID='$uid'";
			$result_update_picture_name = $conn->query($update_picture_name); 
			if($result_update_picture==true)
			{
				$message="Update profile picture success.";
				echo "<script type='text/javascript'>alert('$message');</script>";
				header("Refresh: 0, my_profile.php");				
			}
			else
			{
				$message="Fail to update profile picture. Please try again.";
				echo "<script type='text/javascript'>alert('$message');</script>";
			}
		}
	}		
	if(isset($_POST['editname'])){
		$newname=$_POST['username'];
		$update_name = "UPDATE user_details SET UserFullName='$newname' WHERE UserID='$uid'";
		$result_update_name = mysqli_query($conn, $update_name);
		if($result_update_name){
			$_SESSION['UserFullName']=$newname;
			$message="Update name success.";
			echo "<script type='text/javascript'>alert('$message');</script>";
			header("Refresh: 0, my_profile.php");
		}
		else{
			$message="Fail to update name. Please try again.";
			echo "<script type='text/javascript'>alert('$message');</script>";
		}
	}
	else if(isset($_POST['editemail'])){
		$newemail=$_POST['email'];
		$update_email = "UPDATE user_details SET UserEmail='$newemail' WHERE UserID='$uid'";
		$result_update_email = mysqli_query($conn, $update_email);
		if($result_update_email){
			$message="Update e-mail success.";
			echo "<script type='text/javascript'>alert('$message');</script>";
			header("Refresh: 0, my_profile.php");
		}
		else{
			$message="Fail to update e-mail. Please try again.";
			echo "<script type='text/javascript'>alert('$message');</script>";
		}
	}
?>

<!DOCTYPE html>
<html>
<head>
	<title>Events - Edit Event</title>
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
			margin-top: 15px;
			margin-right: 60px;
		}
		table{
			max-width:750px;
			margin-top:50px;
			margin-bottom:50px;
			margin-left:auto;
			margin-right:auto;
			background-color:#dedede;
			border-radius:15px;
		}
		th{
			font-size: 28px;
			text-align: center;
			padding-top: 20px ;
			width: 50%;
		}
		td, input[type=text], input[type=email]{
			font-family: Times New Roman;
			font-size: 22px;
			text-align: center;
			padding-top: 2px ;
			padding-bottom: 2px ;
		}
		input[type=file]{
			font-family: Times New Roman;
			font-size: 16px;
			text-align: center;
			padding-top: 2px;padding: 12px;
			color: white;
			border: none;
			border-radius:6px;
			background-color:  #2875fa;
			font-weight: 900;
			font-family: Times New Roman;
			font-size: 16px;
			text-align: center;
			width: auto;
			padding-bottom: 2px;
		}
		input[type=submit], input[type=reset]{
			padding: 10px;
			color: black;
			border: none;
			border-radius:10px;
			background-color:#2875fa;
			font-weight: 900;
			font-family: Times New Roman;
			font-size: 20px;
			text-align: center;
			width: 120px;
			transition:background-color 1s;
		}
		input[type=submit]:hover, input[type=reset]:hover{
			color:white;
			background-color:#0f0b3d ;
		}
	</style>
</head>
<body>

	<button onclick="topFunction()" id="myBtn" title="Go to top"></button>
	<div id="epicture">
		<form action="edit_profile.php" method="POST" enctype="multipart/form-data">
			<table align="center" cellspacing="20px">
				<tr><th style="text-decoration: underline;"> -- Edit Profile Picture --</th></tr>
				<tr><td></td></tr>
				<tr><td>New Profile Picture: <input type="file" name="picture"></td></tr>
				<tr><td colspan="2"><input type="submit" name="editpicture" value="Save">&nbsp;&nbsp;&nbsp;&nbsp;
						<input type="reset" name="cancel" value="Cancel"></td></tr>
			</table>
		</form>
	</div>
	<hr width="auto" size="10" style="background: #808000">
	<div id="ename">
		<form action="edit_profile.php" method="POST">
			<table align="center" cellspacing="20px">
				<tr><th style="text-decoration: underline;"> -- Edit Name -- </th></tr>
				<tr><td></td></tr>
				<tr><td>New Name: <input type="text" name="username" size="30" required ></tr>
				<tr><td colspan="2"><input type="submit" name="editname" value="Save">&nbsp;&nbsp;&nbsp;&nbsp;
						<input type="reset" name="cancel" value="Cancel"></td></tr>
			</table>
		</form>
	</div>
	<hr width="auto" size="10" style="background: #808000">
	<div id="eemail">
		<form action="edit_profile.php" method="POST">
			<table align="center" cellspacing="20px">
				<tr><th style="text-decoration: underline;"> -- Edit E-mail -- </th></tr>
				<tr><td></td></tr>
				<tr><td>New E-mail: <input type="email" name="email" size="30" required ></tr>
				<tr><td colspan="2"><input type="submit" name="editemail" value="Save">&nbsp;&nbsp;&nbsp;&nbsp;
						<input type="reset" name="cancel" value="Cancel"></td></tr>
			</table>
		</form>
	</div>
</body>
</html>