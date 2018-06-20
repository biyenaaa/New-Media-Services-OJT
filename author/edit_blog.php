<?php
include "../includes/db_config.php";
include "../includes/db.php";
require_once "../includes/session.php";


$error = "";
$db = new Db();

if(isset($_POST['update'])){
	$id = $_POST['id'];
	$title = $_POST['title'];
	$content = $_POST['content'];
	$date_published = date('Y/m/d H:i:s');

	if(empty($title) || empty($content)){
		if(empty($title)){
			echo "<font color = 'red'>Title is empty</font></br>";
		}

		if(empty($content)){
			echo "<font color = 'red'>Content is empty</font></br>";
		}
	}else{
		$edit = $db -> query("UPDATE posts SET title='$title' content='$content' WHERE post_id=$id AND acc_id='$acc_id' ");
		die("<pre>".$edit."</pre>");
		header("Location: author_blogs.php");
	}
}

$id = $_GET['id'];
$result = $db -> query("SELECT title, content, date_published, acc_id FROM posts WHERE post_id='$id' ");

while($row = $result ->fetch_assoc()){
	$acc_id = $row['acc_id'];
	$title = $row['title'];
	$content = $row['content'];
	$date_published = $row['date_published']; 
}





?>

<!DOCTYPE html>
<html>
<head>
	<title>Editting Blog</title>
</head>
<body>
	<div class="col-12 col-sm-9">
		<form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post" name="edit-blog-post">
			<div class="container-fluid">
				<h4>Update <?php echo $title ;?> blog</h4>
				<p>Title: </p>
				<input type="text" name="title" value="<?php echo $title ?>" required>

				<br><br>

				<p>Blog: </p>
				<textarea name="content" cols="100" rows="15" placeholder="Enter text here..." required ><?php echo $content ;?></textarea>

				<div class="container-fluid">
					<input type="hidden" name="id" value="<?php echo $_POST['id'];?>">
					<input type="submit" name="update" value="Update">
				</div>


			</div>

		</form>
	</div>
</body>
</html>