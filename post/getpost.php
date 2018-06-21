<?php
	include "../includes/db_config.php";
	include "../includes/db.php";
	include "../includes/session.php";
	include "../modules/navbar.php";
	include "../modules/footer.php";

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
		}
		
	}
?>

<!DOCTYPE html>
<html>
<head>
	<title>Blog&White</title>
</head>
<body style="padding-bottom: 10%;">
	<div class="container wrapper">

		<div style="padding-top: 20px;" class="col col-sm-10 card-group container form-group">
    		<label for="exampleFormControlTextarea1 container"><h1><?php echo "$title" ?></h1></label>
    		 by: <?php echo "$username"; ?><br/>
    		 Date Posted: <?php echo "$datepublished"; ?>
    		<textarea readonly class="form-control rounded-0 " id="exampleFormControlTextarea1" rows="10">	<?php echo "$content" ?></textarea>
		</div>

	<div class="container">
		<h6>Leave a comment:</h6>
		<form class="comment" action="comment.php" method="POST">
		<div><input type="text" name="name" placeholder="Name"></div>
		<div><textarea rows="5" cols="60" name="comment" placeholder="Comment"></textarea></div>
		<input type="hidden" name="post_id" value="<?=$_GET['post_id']?>">
		<button type="submit">Enter</button>
		</form>
	</div>

	<div style="padding-top: 10px">
		<?php
		while($rowcom = mysqli_fetch_array($comments)) {
						$name = $rowcom['name'];
						$comment = $rowcom['comment'];
						$datecommented = $rowcom['date_commented'];

						$output = '<tr> '.$name.' said '.$comment.' '.$datecommented.' <tr>';
						
						echo '<table>';
							print("$output");
						echo '</table>';
					}
		?>
	</div>

</div>
</body>
</html>