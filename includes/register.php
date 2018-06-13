<!DOCTYPE html>
<html>
<head>
	<title>Add Account</title>
</head>
<body>
	<?php
	include_once("config.php");

	if(isset($_POST['Submit'])){
		$username = $_POST['username'];
		$email = $_POST['email'];
		$password = $_POST['password'];
	}

	if(empty($username) || empty($password) || empty($email)){
		if(empty($username)){
			echo "<font color=''>*Name Field is empty</font><br>";
		}

		if(empty($email)){
			echo "<font color=''>*E-mail Field is empty</font><br>";
		}

		if(empty($password)){
			echo "<font color=''>*Password Field is empty</font><br>";
		}
	}else{
		$result = mysqli_query($mysqli, "INSERT INTO accounts VALUES('$username','$email','$password')");
		echo "<font color='green'>Data added successfully.</font><br>";
        echo "<br/><a href='index.php'>;
	}

	?>	

</body>
</html>