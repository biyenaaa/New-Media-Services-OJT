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
		<table class="table">
			<tr>
				<th>Title</th>
				<th>Date Published</th>
				<th>Actions</th>
			</tr>


			<?php
			$acc_id = $_SESSION['user_id'];
			$result = $db -> query("SELECT post_id, title, content, date_published FROM posts WHERE acc_id='$acc_id' ");

			while($row = $result->fetch_assoc()){
			$title = $row['title'];
			$username = $row['content'];
			$date_published = $row['date_published'];
			$content = $row['content'];

			$output = 
			'<tr>
				<td>'.$title.'</td>
				<td>'.$date_published.'</td>
				<td><form action="#" method="GET">
					<button type="button" class="view" data-toggle="modal" data-target="#viewContent" name="View">View</button>
					<button type="submit" class="edit" name="Edit"><span class="glyphicon glyphicon-edit"></span> Edit</button>
					<button type="submit" class="edit" name="Delete"><span class="glyphicon glyphicon-trash"></span> Delete</button>
				</form></td>

				<div class="modal fade" id="viewContent" role="dialog">
					<div class="modal-dialog">
						<!-- Modal content-->
						<div class="modal-content">
							<div class="modal-header">
								<button type="button" class="close" data-dismiss="modal">&times;</button>
								<h4 class="modal-title">'.$title.'</h4>
							</div>
							<div class="modal-body">
								<p>'.$content.'</p>
							</div>
							<div class="modal-footer">
								<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
							</div>
						</div>
					</div>
				</div>
				';

				echo $output;
			}
			?>
		</tr>
	</table>

	<br>
</div>

</body>
</html>