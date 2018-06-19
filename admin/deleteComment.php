<?php
	include "../includes/db_config.php";
	include "../includes/db.php";
	require_once "../includes/session.php";

	// checks if the user logged in is an admin account
	if($acc_type!=1){
		header("Location:../login/login.php");
        exit;
	}
	$comment = $_GET['commentId'];

	$db = new Db();
			$toDelete = $db->query("DELETE FROM `comments` WHERE comment_id=$comment;");
	header("Location:comments.php");
?>