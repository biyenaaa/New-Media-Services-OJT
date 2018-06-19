<?php
	include "../includes/db_config.php";
	include "../includes/db.php";
	require_once "../includes/session.php";

	// checks if the user logged in is an admin account
	if($acc_type!=1){
		header("Location:../login/login.php");
        exit;
	}
?>