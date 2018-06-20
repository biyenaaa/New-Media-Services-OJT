<html>
	<head>
		<title> Admin Homepage </title>
		<link rel="stylesheet" type="text/css" href="../style/Admin.css">
	</head>
<body>
<!-- <ul class="side-nav">
	<a href="authors.php">Authors</a>
	<a href="blogs.php">Blogs</a>
	<a href="comments.php">Comments</a>
</ul> -->

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
	$blogs = $db->query("SELECT posts.post_id, accounts.username, posts.title, (DATE_SUB(NOW(), INTERVAL 30 DAY) AND NOW()) AS days FROM posts INNER JOIN accounts ON posts.acc_id=accounts.acc_id;");

	while($rowcom = mysqli_fetch_array($blogs)) {
				$post_id = $rowcom['post_id'];
				$username = $rowcom['username'];
				$title = $rowcom['title'];
				$days = $rowcom['days'];

				$output = '<tr> '.$title.' <i> '.$days.' day/s ago by '.$username.'</i> <tr>';
				
				echo '<div class="content"><table>';
				echo '<form action="publish.php" method="get">';
					print("$output");
				echo '<input type="hidden" name="postId" value="'.$post_id.'">';
				echo '<input type="submit" name="enable" value="publish">
				<input type="submit" name="disable" value="unpublish" formaction="unpublish.php"> </form></table> </div>';
			}
?> 

</body>
</html>