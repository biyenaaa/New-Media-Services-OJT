<?php
include "../includes/db_config.php";
include "../includes/db.php";

session_start();

$error = "";
$db = new Db();

?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
	<title>My Blogs</title>

</head>
<body>
	<nav class="navbar navbar-default">
		<div class="container-fluid">
			<ul class="nav nav-tabs">
				<li role="presentation" class="">
					<a href="#">Profile</a>
				</li>

				<li role="presentation" class="active">
					<a href="author_blogs.php"><span class="glyphicon glyphicon-list-alt"></span> My Blogs</a>
				</li>

				<li role="presentation" class="">
					<a href="profile.php"><span class="glyphicon glyphicon-plus"></span> Create a New Blog</a>
				</li>

				<li role="presentation" class="">
					<a href="../logout.php"><span class="glyphicon glyphicon-log-out"></span> Logout</a>
				</li>
			</ul>
		</div>
	</nav>

	<div class="container-fluid">
		<div class="accordion" id="accordionExample">
			<?php
			$acc_id = $_SESSION['user_id'];
			$result = $db -> query("SELECT post_id, title, content, date_published FROM posts WHERE acc_id='$acc_id' ");

			while($row = $result->fetch_assoc()){
			$post_id = $row['post_id'];
			$title = $row['title'];
			$username = $row['content'];
			$date_published = $row['date_published'];
			$content = $row['content'];

			$output = '
			<div class="container">
				<h4>'.$title.'</h4>
				<p>'.$date_published'</p>
				<button type="button" class="btn btn-info" data-toggle="collapse" data-target="#demo">View</button>
				<div id="demo" class="collapse">
					'.$content.'
				</div>
			</div>


			';

			echo $output;
		}
		?>

	</div>
</div>

<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js" ></script>

</body>
</html>