<?php
	include "../includes/db_config.php";
	include "../includes/db.php";

	session_start();
	
	if($_SERVER["REQUEST_METHOD"] === "POST") {
		if(empty($_POST['username']) || empty($_POST['password'])) {
		} else {
			$username = $_POST['username'];
			$password = $_POST['password'];

			$db =  new Db();
			$result = $db->query("SELECT acc_id, username, acc_type FROM accounts WHERE (username='$username' AND password=md5('$password') AND status = 1);");

			// fetch acc_id
				$user = $result->fetch_assoc();

			//query account type
			$data = $db->query("SELECT acc_type FROM accounts WHERE (username='$username' AND password=md5('$password'))");
			$row = mysqli_fetch_array($data);
			$accountType = $row['acc_type'];	


			if(!empty($user['acc_id'])) {
				$_SESSION['user_id'] =  $user['acc_id'];
				$_SESSION['user_name'] = $user['username'];

				if($accountType=='1'){
					header("location: ../admin/homepage.php");
				}
				else{
					header("location: ../author/author_blogs.php");
				}
			} else {
				$_SESSION['errmsg'] = 'Username or Password is invalid.';
				header("location: login.php");
			}
		}
	}
?>
