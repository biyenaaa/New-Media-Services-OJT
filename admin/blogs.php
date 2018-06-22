<?php
	include "../includes/db_config.php";
	include "../includes/db.php";
	require_once "../includes/session.php";
	include "../modules/navbar.php";
?>
<html>
	<head>
		<title> Admin Homepage </title>
		<link rel="stylesheet" type="text/css" href="../style/style.css">
	</head>
<body style="padding-bottom: 10%;">

<?php 
	// checks if the user logged in is an admin account
	if($acc_type!=1){
		header("Location:../login/login.php");
        exit;
	}

	$db = new Db();
	$blogs = $db->query("SELECT posts.post_id, accounts.username, posts.title, posts.status, posts.date_published AS days FROM posts INNER JOIN accounts ON posts.acc_id=accounts.acc_id;");

?>
	<div class="page-header text-center"><h1>Blogs</h1></div>
	<div class=" container col col-sm-8 ">
	<table class="table table-bordered table-hover">
		<thead>
		    <tr>
		      <th scope="col">Title</th>
		      <th scope="col">Author</th>
		      <th scope="col">Date Published</th>
		      <th scope="col">Post</th>
		    </tr>
  		</thead>
<?php
	while($rowcom = mysqli_fetch_array($blogs)) {
				$post_id = $rowcom['post_id'];
				$username = $rowcom['username'];
				$title = $rowcom['title'];
				$days = $rowcom['days'];
				$status = $rowcom['status'];

				echo '
						<tr>
							<td>
								<a href=../post/getpost.php?post_id='.$post_id.'> '.$title.'
								</a>
							</td>
							<td>
								'.$username.'
							</td>

							<td>
								'.$days.'
							</td>
							<td>
								<form action="publish.php" method="get">
								<input type="hidden" name="postId" value="'.$post_id.'">';
									if($status=="0"){
										echo '<input class="btn btn-outline-dark" type="submit" name="enable" value="publish">';
									}
									else{
										echo '<input class="btn btn-outline-danger" type="submit" name="disable" value="unpublish" formaction="unpublish.php">';
									}
									echo'
								</form>
							</td>
						</tr>
					
				';
			}
			echo "</table></div>";
include "../modules/footer.php";
?> 

</body>
</html>