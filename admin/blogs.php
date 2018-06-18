
<?php 
     //require_once "../includes/loginprocess.php";
	include "../includes/db_config.php";
	include "../includes/db.php";

	session_start();

	$db = new Db();
	$blog = $db->query("SELECT p.title, p.date_published, a.username FROM posts as p NATURAL JOIN accounts as a ORDER BY date_published DESC;");
	while($row = mysqli_fetch_array($blog)){
		$title = $row['title'];
		$username = $row['username'];
		$date = $row['date_published'];

		$output = '<div> '.$title.' by '.$username.' '.$date.' </div>';
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