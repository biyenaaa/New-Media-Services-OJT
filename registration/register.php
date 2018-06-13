<?php
include "../includes/db_config.php";
include "../includes/db.php";

$error = "";
$db = new Db();
if(isset($_POST['Submit'])){
	$username = $_POST['username'];
	$password = $_POST['password'];
	$email = $_POST['email'];

	if(empty($username) || empty($password) || empty($email)){
		if(empty($username)){
			echo "<font color='red'>Username field is empty</font><br/>";
			echo $error;
		}

		if(empty($password)){
			echo "<font color='red'><i>Password field is empty</i></font><br/>";
			echo $error;
		}

		if(empty($email)){
			echo "<font color='red'>Email field is empty</font><br/>";
			echo $error;
		}
	}else{
		$result = $db->query("INSERT INTO accounts(username, password, email) VALUES('$username', md5('$password'), '$email'); ");

		#echo "<font color='green'>Data added successfully.</font><br>";
	}
}
?>

<!DOCTYPE html>
<html>
<head>
	<title>Account Added</title>
</head>
<body>
	<a href="register.php">Registration</a>
	<br/>
	<br/>

	<form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post" name="registration">
		<table//>
			<!--username-->
			<tr>
				<td>Username</td>
				<td>
					<input type="text" name="username">
				</td>
			</tr>

			<!--password-->
			<tr>
				<td>Password</td>
				<td>
					<input type="password" name="password">
				</td>
			</tr>

			<!--email-->
			<tr>
				<td>Email</td>
				<td>
					<input type="email" name="email">
				</td>
			</tr>

			<tr> 
				<td></td>
				<td><input type="submit" name="Submit" value="Register"></td>
			</tr>

		</table>
	</form>
	
</body>
</html>