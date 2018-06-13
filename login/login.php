<?php
	include "includes/db_config.php";
	include "includes/db.php";

	session_start();
	$error = "";

	if($_SERVER["REQUEST_METHOD"] === "POST") {
		if(empty($_POST['username']) || empty($_POST['password'])) {
			$error = "Username or Password is incorrect.";
			echo $error;
		} else {
			$username = $_POST['username'];
			$password = $_POST['password'];

			$db =  new Db();
			$result = $db->query("SELECT * FROM accounts WHERE username='$username' AND password=md5('$password');");
			if($result) {
				header("location: index.php");
			} else {
				$error = "User not found.";
				echo $error;
			}
		}
	}
?>


<!DOCTYPE html>
<html>
<head>
	<title>Blog&White</title>
</head>
<body>
<h1>Blog&White</h1>

<form action="loginprocess.php">
	<div class="container">
		<center>
			<label for="uname">Username</label>
			<input type="text" placeholder="Enter Username" name="uname" required><br/>

			<label for="psw">Password</label>
			<input type="password" placeholder="Enter Password" name="psw" required><br/>

			<button type="submit">Sign-in</button><br/>
				<center class="psw">Do not have an account? <a href="localhost:PORT/registration">Sign-up</a></center>
		</center>
	</div>
</form>
</body>
</html>