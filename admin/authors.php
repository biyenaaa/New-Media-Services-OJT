<html>
	<head>
		<title> Admin Homepage </title>
		<link rel="stylesheet" type="text/css" href="../style/Admin.css">
	</head>
<body>
<ul class="top-nav">
	<a href="index.php">Home</a>
	<a href="login/login.php">Sign-in</a>
	<a href="registration/register.php">Sign-up</a>
</ul>

<ul class="side-nav">
	<a href="authors.php">Authors</a>
	<a href="blogs.php">Blogs</a>
	<a href="comments.php">Comments</a>
</ul>

<?php 
	include "../includes/db_config.php";
	include "../includes/db.php";
	require_once "../includes/session.php";

	// checks if the user logged in is an admin account
	if($acc_type!=1){
		header("Location:../login/login.php");
        exit;
	}

	$db = new Db();
	$authors = $db->query("SELECT acc_id, username, (DATE_SUB(NOW(), INTERVAL 30 DAY) AND NOW()) AS days FROM `accounts` WHERE acc_type=0");

	while($rowcom = mysqli_fetch_array($authors)) {
				$acc_id = $rowcom['acc_id'];
				$username = $rowcom['username'];
				$days = $rowcom['days'];

				$output = '<tr> '.$username.' <i> joined '.$days.' day/s ago</i> <tr>';
				
				echo '<div class="content"><table>';
				echo '<form action="enableAccount.php" method="get">';
					print("$output");
				echo '<input type="hidden" name="accId" value="'.$acc_id.'">';
				echo '<input type="submit" name="enable" value="enable">
				<input type="submit" name="disable" value="disable" formaction="disableAccount.php"> </form></table> </div>';
			}
?> 

</body>
</html>