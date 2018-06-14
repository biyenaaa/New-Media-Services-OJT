<?php
	include "../includes/db_config.php";
	include "../includes/db.php";

	session_start();
	
	if($_SERVER["REQUEST_METHOD"] === "POST") {
		if(empty($_POST['username']) || empty($_POST['password'])) {
		die(var_dump($_POST));
		} else {
			$username = $_POST['username'];
			$password = $_POST['password'];

			$db =  new Db();
			$result = $db->query("SELECT * FROM accounts WHERE username='$username' AND password=md5('$password') AND STATUS = 1;");
			if($result) {
				header("location: index.php");
			} else {
				$_SESSION['errmsg'] = 'Username or Password is invalid.';
				header("location: login.php");
			}
		}
	}
?>
