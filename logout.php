<!DOCTYPE html>
<html>
<head>
	<title>Logout - page</title>
</head>
<body style="margin-top: 30px;text-align: center;">
<?php
	session_start();
	if (isset($_SESSION['UserFullName'])){
		session_destroy();
		echo "<h1>Logout successfull. Redirect to home page in 3 seconds. <br>Click <a href='index.php'>here</a> if no response.</h1>";
		header('Refresh: 2; index.php');
	}
?>
</body>
</html>
