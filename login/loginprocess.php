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
			$result = $db->query("SELECT acc_id FROM accounts WHERE username='$username' AND password=md5('$password');");
			if($result) {

				// fetch acc_id
				$user = $result->fetch_assoc();

				// session var = 
				//die(var_dump($user['acc_id']));
				//die(var_dump($user['acc_id']));
				$_SESSION['user_id'] =  $user['acc_id'];
				$_SESSION['user_name'] = $user['username'];
				header("location: ../author/profile.php");
			} else {
				$_SESSION['errmsg'] = 'Username or Password is invalid.';
				header("location: login.php");
			}
		}
	}
?>
