<?php
	include "../includes/db_config.php";
	include "../includes/db.php";

	session_start();

	if($_SERVER["REQUEST_METHOD"] === "POST") {
		if(empty($_POST['name']) || empty($_POST['comment'])) {
			header("location: getpost.php");
		}else {
			$name = $_POST['name'];
			$comment = $_POST['comment'];
			$postid = $_POST['post_id'];

			$db = new Db();
			$comment = $db->query("INSERT INTO `comments` (`post_id`, `name`, `comment`, `date_commented`) VALUES ('$postid', '$name', '$comment', CURRENT_TIMESTAMP)");
			header("location: ../index.php");

			die(var_dump($comment));

		}
	}
?>