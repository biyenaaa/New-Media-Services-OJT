
<?php 
	include "../includes/db_config.php";
	include "../includes/db.php";
	require_once "../includes/session.php";

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
		<link rel="stylesheet" type="text/css" href="../style/Admin.css">
	</head>
<body>
<ul class="top-nav">
	<a href="#">Home</a>
	<!-- <a href="login/login.php">Sign-in</a>
	<a href="registration/register.php">Sign-up</a> -->
	<a href="../logout.php">Logout</a>
</ul>

<ul class="side-nav">
	<a href="authors.php">Authors</a>
	<a href="blogs.php">Blogs</a>
	<a href="comments.php">Comments</a>
</ul>

<?php print("$output"); ?>

</body>
</html>