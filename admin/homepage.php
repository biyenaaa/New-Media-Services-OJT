
<?php 
     //require_once "../includes/loginprocess.php";
	include "../includes/db_config.php";
	include "../includes/db.php";

	session_start();

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