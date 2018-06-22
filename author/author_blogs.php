<?php
include "../includes/db_config.php";
include "../includes/db.php";
include "../includes/session.php";
include "../modules/navbar.php";


$error = "";
$db = new Db();

function limitTextWords($words = false, $limit = false, $stripTags = false, $ellipsis = false) 
{
	if ($words && $limit) {
	$words = ($stripTags ? strip_tags($words) : $words);
	$ellipsis = ($ellipsis ? "..." : $ellipsis);
	$words  = mb_strimwidth($words, 0, $limit, $ellipsis);

}
return $words;
}
?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<!-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css"> -->
	<title>My Blogs</title>

</head>
<body style="padding-bottom: 10%;">
	<br>
	<div class="container-fluid">
		<div class="accordion" id="accordionExample">
			<?php
			$acc_id = $_SESSION['user_id'];
			$result = $db -> query("SELECT post_id, title, content, date_published FROM posts WHERE acc_id='$acc_id' AND status = 1 ORDER BY date_published DESC; ");

			$noBlogs = '
	            <center><div class="card-body panel-footer">
					<div class="btn-group">
						<ul class="list-inline">
							<li class="container-fluid">
								<p>You have no blogs yet.</p>
								<a href="create_blogs.php" role="button" class="btn btn-outline-dark" id="create">Write Blog</a>
							</li>
						</ul>
					</div>
				</div></center>
             ';
			if (mysqli_num_rows($result)==0){
                print("$noBlogs");
              }

			while($row = $result->fetch_assoc()){
			$post_id = $row['post_id'];
			$title = $row['title'];
			$date_published = $row['date_published'];
			$content = $row['content'];

			$output = '
			<div class="container col col-sm-6 card panel panel-default">
				<div class=" card-body panel-heading">
					<ul class="list-inline">
						<li>
							<p class="text-right"><small>'.$date_published.'</small></p>
							<h3><strong>'.$title.'</strong></h3>
							
						</li>
					</ul>

				</div>

				<div class="card-body panel-body" style="border-color:#d3d3d3;">

					<p class="lead">'.limitTextWords($content, 50, true, true).'</p>

					</div>
					<div class="card-body panel-footer">
						<div class="btn-group">
							<ul class="list-inline">
								<li class="container-fluid">
									<a href=../post/getpost.php?post_id='.$post_id.' role="button" class="btn btn-outline-dark" id="comments">View</a>
									<a href="edit_blog.php?id='.$post_id.'" role="button" class="btn btn-outline-dark" id="edit" name="edit">Edit</a>
									<a href=delete_blogs.php?post_id='.$post_id.' role="button" class="btn btn-outline-dark" id="delete">Delete</a>
								</li>
							</ul>
						</div>
					</div>

				</div>
				<br>
				';
                print("$output");
			}
			?>

		</div>
	</div>

	<?php include "../modules/footer.php"; ?>

	<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js" ></script>

</body>
</html>