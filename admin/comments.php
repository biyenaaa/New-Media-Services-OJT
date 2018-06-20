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
	$comments = $db->query("SELECT c.comment_id, c.name, c.comment, c.date_commented FROM comments as c NATURAL JOIN posts ORDER BY c.date_commented DESC;");

	while($rowcom = mysqli_fetch_array($comments)) {
				$comment_id = $rowcom['comment_id'];
				$name = $rowcom['name'];
				$comment = $rowcom['comment'];
				$datecommented = $rowcom['date_commented'];

				$output = '<tr> '.$name.' said '.$comment.' '.$datecommented.' <tr>';
				
				echo '<div class="content"><table>';
				echo '<form action="deleteComment.php" method="get">';
					print("$output");
				echo '<input type="hidden" name="commentId" value="'.$comment_id.'">';
				echo '<input type="submit" value="delete"></form></table> </div>';
			}
?> 

</body>
</html>