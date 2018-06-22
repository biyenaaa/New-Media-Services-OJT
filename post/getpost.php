<?php
	include "../includes/db_config.php";
	include "../includes/db.php";
	
	session_start();
        if(isset($_SESSION['user_id'])){
            $checkUserId = $_SESSION['user_id'];
            $checkUser = $_SESSION['user_name'];
            $db = new Db();
            $sessionSql = $db->query("SELECT `acc_id`, `username`, `email`, `password`, `acc_type`, `date_registered`, `status` FROM `accounts` where username = '$checkUser';");
            $row = mysqli_fetch_array($sessionSql, MYSQLI_ASSOC);
            $acc_id = $row['acc_id'];
            $username = $row['username'];
            $email = $row['email'];
            $password = $row['password'];
            $acc_type = $row['acc_type'];
            $date_registered = $row['date_registered'];
            $status = $row['status'];
        }
	include "../modules/navbar.php";

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
	<link rel="stylesheet" src="../style/style.css">
</head>
<body style="padding-bottom: 10%;">
	<div class="container wrapper">

		<!-- <div style="padding-top: 20px;" class="col col-sm-10 card-group container form-group"> -->
    		<label for="exampleFormControlTextarea1 container"><h1><?php echo "$title" ?></h1></label>
    		<span class="align-middle">
    			by: <?php echo "$username"; ?>
    		</span>
    		<textarea readonly class="form-control rounded-0 " id="exampleFormControlTextarea1" rows="10"><?php echo "$content" ?></textarea>
    		<span class="float-sm-right">
    		 	Date Posted: <?php echo "$datepublished"; ?>
    		</span>
    	<div class="divider"></div>
		<h6>Leave a comment:</h6>
		<form class="comment" action="comment.php" method="POST">
		<div><input type="text" name="name" placeholder="Name" required></div><br>
		<div><textarea rows="5" cols="60" name="comment" placeholder="Comment" required></textarea></div>
		<input type="hidden" name="post_id" value="<?=$_GET['post_id']?>">
		<button type="submit" class="btn btn-outline-dark">Enter</button>
		</form>

	<div class="divider"></div>	

	<div style="padding-top: 10px">
		<?php
		while($rowcom = mysqli_fetch_array($comments)) {
			$name = $rowcom['name'];
			$comment = $rowcom['comment'];
			$datecommented = $rowcom['date_commented'];

			echo '
				<div class="card col-6">
	  				<div class="card-body">
		    			<h5 class="card-title">'.$name.'</h5>
		    			<p class="card-text">
		      				'.$comment.'
		    			</p>
	  				</div>
	  			<h6 class="card-subtitle mb-2 text-muted text-right">'.$datecommented.'</h6>
				</div>
			';
					}
		?>
	</div>
</div>
<?php include "../modules/footer.php"; ?>
</body>
</html>