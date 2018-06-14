<?php
	include "includes/db_config.php";
	include "includes/db.php";

	session_start();

	$db = new Db();
	$result = $db->query("SELECT p.post_id, a.username, p.title, p.date_published FROM accounts as a NATURAL JOIN posts as p WHERE p.status = 1 ORDER BY date_published DESC;");
	while($row = mysqli_fetch_array($result)) {
		$title = $row['title'];
		$username = $row['username'];
		$datepublished = $row['date_published'];
		$postid = $row['post_id'];

		$output = '<div> <form action="getpost.php" method="GET"><input type="hidden" name="post_id" value="'.$postid.'"><input type="hidden" name="title" value="'.$title.'"><button type="submit" class="submitbutton"> '.$title.' </button></form> '.$username.' '.$datepublished.' </div>';
	}
?>

<!DOCTYPE html>
<html>
<head>
	<title>Blog&White</title>
</head>
<body>
<ul class="navbar">
	<a href="index.php">Home</a>
	<a href="login/login.php">Sign-in</a>
	<a href="registration/register.php">Sign-up</a>
</ul>

<h1>Blog&White</h1>
<h2>Latest Articles</h2>

<?php
	print("$output");
?>


</body>
</html>