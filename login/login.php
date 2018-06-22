<?php
	include "../modules/navbar.php";
	include "../modules/footer.php";
?>


<!DOCTYPE html>
<html>
<head>
	<title>Blog&White</title>
	<meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="../style/style.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>
<body style="padding-bottom: 10%">

<div class="panel panel-default">
	<div class="border-dark" style="border-color: black;">
		<div class="panel-body">
			<br><br><br>
			<center><h2>Blog & White</h2></center>
			<form class="form-login" action="loginprocess.php" method="POST">
				<center>
				<table>
					<tr>
						<td><label for="uname">Username</label></td>
						<td><input type="text" name="username" required><br/></td>
					</tr>

					<tr>
						<td><label for="psw">Password</label></td>
						<td><input type="password" name="password" required><br/></td>
					</tr>
				</table>
				
					<?php
						session_start();
						if (isset($_SESSION['errmsg'])) {
							echo $_SESSION['errmsg'];
							unset($_SESSION['errmsg']);
						}else {
							echo "";
						}
					?>
					<br>
					<center><button type="submit" class="btn btn-outline-dark">Sign-in</button></center></td>
					<br>
					<center class="psw">Don't have an account? <a href="../registration/register.php">Sign-up</a></center>
				</center>
			</form>
	</div>
</div>
</body>
