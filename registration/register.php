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
		header("location: ../index.php");

#echo "<font color='green'>Data added successfully.</font><br>";
	}
}
?>

<!DOCTYPE html>
<html>
<head>
	<title>Account Added</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<link rel="stylesheet" href="../style/style.css">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>
<body>
	<div class="navig"> 
		<nav class="navbar navbar-expand-lg navbar-light bg-light">
			<?php
			if(isset($acc_type)){
				if($acc_type=="0"){
					echo '<a class="navbar-brand" href="../index.php">Blog & White</a>';
				}
				else{
					echo '<a class="navbar-brand" href="../admin/homepage.php">Blog & White</a>';
				}
			}
			else{
				echo '<a class="navbar-brand" href="../index.php">Blog & White</a>';
			}
			?>

			<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarText" aria-controls="navbarText" aria-expanded="false" aria-label="Toggle navigation">
				<span class="navbar-toggler-icon"></span>
			</button>
			<div class="collapse navbar-collapse" id="navbarText">
				<ul class="navbar-nav mr-auto">
					<?php
					if(isset($checkUser)and$acc_type=='0'){
						echo '
						<li class="nav-item">
						<a class="nav-link" href="../author/author_blogs.php"> My Blogs <span class="sr-only">(current)</span></a>
						</li>
						<li class="nav-item">
						<a class="nav-link" href="../author/create_blogs.php"> Write a Blog <span class="sr-only">(current)</span></a>
						</li>';
					}
					if(isset($checkUser)and$acc_type=='1'){
						echo '
						<li class="nav-item">
						<a class="nav-link" href="../admin/blogs.php">Blogs <span class="sr-only">(current)</span></a>
						</li>
						<li class="nav-item">
						<a class="nav-link" href="../admin/authors.php"> Authors <span class="sr-only">(current)</span></a>
						</li>
						<li class="nav-item">
						<a class="nav-link" href="../admin/comments.php"> Comments <span class="sr-only">(current)</span></a>
						</li>';
					}
					?>
				</ul>
				<?php
				if(isset($checkUser)){
					echo '
					<span class="navbar-text">
					logged in as '.$checkUser.'
					</span>
					<div class="divider"></div>
					<a href="../logout.php">
					<button type="button" class="btn btn-sm">
					<span class="glyphicon glyphicon-log-out">Log out</span> 
					</button>
					</a>
					';}
					else{
						echo '
						<a href="../login/login.php">
						<button type="button" class="btn btn-sm">
						<span class="glyphicon glyphicon-log-in">Log in</span> 
						</button>
						</a>
						<div class="divider"></div>
						<a href="../registration/register.php">
						<button type="button" class="btn btn-sm">
						<span class="glyphicon glyphicon-log-out">Sign up</span> 
						</button>
						</a>';
					}
					?>
				</div>
			</nav>
		</div>
		<br>

		<main role="main" class="container">
			<div class="row">
				<div class="container-fluid">

					<h4><a href="register.php">Registration</a></h4>

					<form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post" name="registration">
						<table class="table table-hover">
							<div class="col-sm-6">
								<div class="form-group">
									<label for="username"> Username</label>
									<input class="form-control" type="text" name="username" required>
								</div>

								<div class="form-group">
									<label for="password"> Password</label>
									<input class="form-control" type="password" name="password" required>
								</div>

								<div class="form-group">
									<label for="email"> Email</label>
									<input class="form-control" type="email" name="email" required>
								</div>

								<div class="form-group">
									<input class="button" type="submit" name="Submit" value="Register">
								</div>
							</div>
						</table>
					</form>
				</div>
			</div>
		</main>

	</body>
	</html>