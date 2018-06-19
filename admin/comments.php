
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
	$comment = $db->query("SELECT name, comment, date_commented FROM comments ORDER BY date_commented DESC;");
	while($row = mysqli_fetch_array($comment)){
		$name = $row['name'];
		$comment = $row['comment'];
		$date = $row['date_commented'];

		$output = '<div> '.$name.' said '.$comment.' '.$date.' </div>';
	}
?> 

<html>
	<head>
		<title> Admin Homepage </title>
		<link rel="stylesheet" type="text/css" href="../style/Admin.css">
	</head>
<body>
<ul class="top-nav">
	<a href="index.php">Home</a>
	<a href="login/login.php">Sign-in</a>
	<a href="registration/register.php">Sign-up</a>
</ul>

<ul class="side-nav">
	<a href="authors.php">Authors</a>
	<a href="blogs.php">Blogs</a>
	<a href="comments.php">Comments</a>
</ul>

<?php print("$output"); ?>

</body>
</html>