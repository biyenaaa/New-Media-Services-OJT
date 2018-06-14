<!DOCTYPE html>
<html>
<head>
	<title>Blog&White</title>
</head>
<body>
<h1>Blog&White</h1>

<form class="form-login" action="loginprocess.php" method="POST">
	<div class="container">
		<center>
			<label for="uname">Username</label>
			<input type="text" name="username" required><br/>

			<label for="psw">Password</label>
			<input type="password" name="password" required><br/>
			<?PHP
				session_start();
				if (isset($_SESSION['errmsg'])) {
					echo $_SESSION['errmsg'];
					unset($_SESSION['errmsg']);
				}else {
					echo "";
				}
			?>
			<button type="submit">Sign-in</button><br/>
				<center class="psw">Don't have an account? <a href="../registration/register.php">Sign-up</a></center>
		</center>
	</div>
</form>
</body>
