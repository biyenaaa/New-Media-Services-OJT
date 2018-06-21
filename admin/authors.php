<html>
	<head>
		<title> Admin Homepage </title>
		<link rel="stylesheet" type="text/css" href="../style/Admin.css">
	</head>
<body>

<?php 
	include "../includes/db_config.php";
	include "../includes/db.php";
	require_once "../includes/session.php";
	include "../modules/navbar.php";

	// checks if the user logged in is an admin account
	if($acc_type!=1){
		header("Location:../login/login.php");
        exit;
	}

	$db = new Db();
	$authors = $db->query("SELECT acc_id, username, date_registered AS days, status  FROM `accounts` WHERE acc_type=0");
	?>

	<div class="page-header text-center"><h1>Author Accounts</h1></div>
	<div class=" container col col-sm-8 ">
	<table class="table table-bordered table-hover">
		<thead>
		    <tr>
		      <th scope="col">Username</th>
		      <th scope="col">Date Joined</th>
		      <th scope="col">Account</th>
		    </tr>
  		</thead>

	<?php
	while($rowcom = mysqli_fetch_array($authors)) {
				$acc_id = $rowcom['acc_id'];
				$username = $rowcom['username'];
				$days = $rowcom['days'];
				$status = $rowcom['status'];
				
				echo '
						<tr>
							<td>
								'.$username.'
							</td>
							<td>
								'.$days.'
							</td>
							<td>
								<form action="enableAccount.php" method="get">
								<input type="hidden" name="accId" value="'.$acc_id.'">';
									if($status=="0"){
										echo '<input class="btn-success" type="submit" name="enable" value="enable">';
									}
									else{
										echo '<input class="btn-danger" type="submit" name="disable" value="disable" formaction="disableAccount.php">';
									}
									echo'
								</form>
							</td>
						</tr>
					
				';
				// echo '<div class="content"><table>';
				// echo '<form action="enableAccount.php" method="get">';
				// 	print("$output");
				// echo '<input type="hidden" name="accId" value="'.$acc_id.'">';
				// echo '<input type="submit" name="enable" value="enable">
				// <input type="submit" name="disable" value="disable" formaction="disableAccount.php"> </form></table> </div>';
			}
			echo "</table></div>";
?> 

</body>
</html>