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
				<li role="presentation" class="active">
					<a href="#">Profile</a>
				</li>

				<li role="presentation" class="active">
					<a href="author_blogs.php">My Blogs</a>
				</li>

				<li role="profile.php" class="active">
					<a href="profile.php">Create a New Blog</a>
				</li>

			</ul>

		</div>
	</nav>

	<div class="container-fluid">
		<table class="table">
			<tr>
				<th>Title</th>
				<th>Date Published</th>
				<th>Actions</th>
			</tr>


			<?php
			$acc_id = $_SESSION['user_id'];
			$result = $db -> query("SELECT title, content, date_published FROM posts WHERE acc_id='$acc_id' ");

			while($row = $result->fetch_assoc()){
				$title = $row['title'];
				$username = $row['content'];
				$date_published = $row['date_published'];

				$output = 


				'<tr>
				<td>'.$title.'</td>
				<td>'.$date_published.'</td>
				<td><form action="#" method="GET">
				<button type="submit" class="view" name="View">View</button>
				<button type="submit" class="edit" name="Edit">Edit</button>
				<button type="submit" class="edit" name="Delete">Delete</button>
				</form></td>
				';

				echo $output;
			}
			?>

		</tr>
	</table>
</div>

</body>
</html>