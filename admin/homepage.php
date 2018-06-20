<?php 
	include "../includes/db_config.php";
	include "../includes/db.php";
	require_once "../includes/session.php";
	include "../modules/navbar.php";
	// checks if the user logged in is an admin account
	if($acc_type!=1){
		header("Location:../login/login.php");
        exit;
	}

	$db = new Db();
	$author = $db->query("SELECT username, date_registered FROM accounts ORDER BY date_registered DESC;");
	while($row = mysqli_fetch_array($author)){
		$username = $row['username'];
		$date = $row['date_registered'];

		$output = '<div> '.$username.' joined '.$date.' </div>';
	}
?> 

<html>
	<head>
		<title> Admin Homepage </title>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<meta http-equiv="X-UA-Compatible" content="ie=edge">
    	<link rel="stylesheet" href="../style/style.css">
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
	</head>
<body>

<!-- <div class="content wrapper">
	<div class="sideNavigation">
		<ul class="nav nav-tabs">
  			<li class="nav-item">
    			<a class="nav-link" href="blogs.php">Blogs</a>
  			</li>
  			<li class="nav-item">
    			<a class="nav-link" href="authors.php">Authors</a>
  			</li>
  			<li class="nav-item">
    			<a class="nav-link" href="comments.php">Comments</a>
  			</li>
		</ul>
	</div>
	<div class="tabPages">
		stuff
	</div>
</div> -->
</div>
</body>
</html>