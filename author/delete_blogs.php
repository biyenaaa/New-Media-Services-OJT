<?php
	include "../includes/db_config.php";
	include "../includes/db.php";

	//session_start();

	$postid = $_GET['post_id'];

	$db = new Db();
	$delete = $db->query("DELETE FROM `posts` WHERE post_id=$postid");
	
	header("location: author_blogs.php");

?>