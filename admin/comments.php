<html>
	<head>
		<title> Admin Homepage </title>
		<link rel="stylesheet" type="text/css" href="../style/Admin.css">
	</head>
<body style="padding-bottom: 20px">

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
	$comments = $db->query("SELECT c.comment_id, c.name, c.comment, c.date_commented, p.title, p.post_id FROM comments as c NATURAL JOIN posts as p ORDER BY c.date_commented DESC;");
?>
	<div class="page-header text-center"><h1>Comments</h1></div>
	<div class=" container col col-sm-8 ">
	<table class="table table-bordered table-hover">
		<thead>
		    <tr>
		      <th scope="col">Post</th>
		      <th scope="col">Name</th>
		      <th scope="col">Comment</th>
		      <th scope="col">Date Commented</th>
		      <th scope="col"></th>
		    </tr>
  		</thead>
<?php
	while($rowcom = mysqli_fetch_array($comments)) {
				$title = $rowcom['title'];
				$comment_id = $rowcom['comment_id'];
				$name = $rowcom['name'];
				$comment = $rowcom['comment'];
				$dateCommented = $rowcom['date_commented'];
				$post_id = $rowcom['post_id'];

				echo '
						<tr>
							<td><a href=../post/getpost.php?post_id='.$post_id.'> '.$title.'
								</a>
							</td>
							</td>
							<td>
								'.$name.'
							</td>
							<td>
								'.$comment.'
							</td>
							<td>
								'.$dateCommented.'
							</td>
							<td>
								<form action="deleteComment.php" method="get">
									<input type="hidden" name="commentId" value="'.$comment_id.'">
									<input class="btn btn-outline-danger" type="submit" value="delete"></form>
							</td>
						</tr>
					
				';
				// echo '<div class="content"><table>';
				
			}
			echo "</table></div>";
include "../modules/footer.php";
?> 

</body>
</html>