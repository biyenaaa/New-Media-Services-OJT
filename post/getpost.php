<?php
	include "../includes/db_config.php";
	include "../includes/db.php";

	session_start();

	$db = new Db();
	if($_SERVER["REQUEST_METHOD"] === "GET") {
		if(empty($_GET['post_id'])) {
			echo "The post is unavailable.";
		} else {
			$postid = $_GET['post_id'];
			$result = $db->query("SELECT a.username, p.title, p.date_published, p.content FROM accounts as a NATURAL JOIN posts as p WHERE p.post_id = '$postid';");

			$row = mysqli_fetch_array($result);
			$title = $row['title'];
			$username = $row['username'];
			$datepublished = $row['date_published'];
			$content = $row['content'];

			$comments = $db->query("SELECT c.name, c.comment, c.date_commented FROM comments as c NATURAL JOIN posts WHERE posts.post_id = '$postid' ORDER BY c.date_commented DESC;");

			while($rowcom = mysqli_fetch_array($comments)) {
				$name = $rowcom['name'];
				$comment = $rowcom['comment'];
				$datecommented = $rowcom['date_commented'];

				$output = '<tr> '.$name.' said '.$comment.' '.$datecommented.' <tr>';
			}
		}
		
	}
?>

<!DOCTYPE html>
<html>
<head>
	<title>'.$title.'</title>
</head>
<body>

<?php
	echo '<h1> '.$title.' </h1>';
	echo '<h2> Author: '.$username.' '.$datepublished.' </h2>';
	echo '<p> '.$content.' <p>'
?>

<br><br>

<h3>Comments</h3>
<table>
	<?php print("$output")?>
</table>


</body>
</html>