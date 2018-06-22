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
	$author = $db->query("SELECT username, date_registered FROM accounts ORDER BY date_registered DESC;");
	while($row = mysqli_fetch_array($author)){
		$username = $row['username'];
		$date = $row['date_registered'];

		$output = '<div> '.$username.' joined '.$date.' </div>';
	}

	// number published blogs
	$data = $db->query("SELECT count(post_id) AS count FROM posts WHERE status=1");
	$row = mysqli_fetch_array($data);
	$published = $row['count'];

	// number of unpublished blogs
	$data = $db->query("SELECT count(post_id) AS count FROM posts WHERE status=0");
	$row = mysqli_fetch_array($data);
	$unpublished = $row['count'];

	// number of enabled accounts
	$data = $db->query("SELECT count(acc_id) AS count FROM accounts WHERE status=1");
	$row = mysqli_fetch_array($data);
	$enabled = $row['count'];

	// number of disabled accounts
	$data = $db->query("SELECT count(acc_id) AS count FROM accounts WHERE status=0");
	$row = mysqli_fetch_array($data);
	$disabled = $row['count'];

	// number of comments
	$data = $db->query("SELECT count(comment_id) AS count FROM comments");
	$row = mysqli_fetch_array($data);
	$comments = $row['count'];
?> 

<html>
	<head>
		<title> Admin Homepage </title>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<meta http-equiv="X-UA-Compatible" content="ie=edge">
    	<link rel="stylesheet" href="../style/style.css">
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
	</head>
<body>
	<div style="margin-top: 10%;" class="wrapper container col col-sm-10 card-group">
	  <div class="card">
	    <div class="card-body">
	      <center><h5 class="card-title"><a href="blogs.php">Blogs</a></h5></center>
	      <p class="card-text">
	      	Published blogs: <?php echo "$published"; ?>
	      </p>
	      <p class="card-text">
	      	Unpublished blogs: <?php echo "$unpublished" ?>
	      </p>
	    </div>
	  </div>
	  <div class="card">
	    <div class="card-body">
	      <center><h5 class="card-title"><a href="authors.php">Author Accounts</a></h5></center>
	      <p class="card-text">
	      	Enabled accounts: <?php echo "$enabled" ?>
	      </p>
	      <p class="card-text">
	      	Disabled Accounts: <?php echo "$disabled" ?>
	      </p>
	    </div>
	  </div>
	  <div class="card">
	    <div class="card-body">
	      <center><h5 class="card-title"><a href="comments.php">Comments</a></h5></center>
	      <p class="card-text">
	      	Comments: <?php echo "$comments" ?>
	      </p>
	    </div>
	  </div>
	</div>
<!-- <div class="content wrapper">
	<div class="sideNavigation">
		<ul class="nav nav-tabs">
  			<li class="nav-item">
    			<a class="nav-link" href="blogs.php">Blogs</a>
  			</li>
  			<li class="nav-item">
    			<a class="nav-link" href="authors.php">Authors</a>
  			</li>
  			<li class="nav-item">
    			<a class="nav-link" href="comments.php">Comments</a>
  			</li>
		</ul>
	</div>
	<div class="tabPages">
		stuff
	</div>
</div> -->
</div>
<?php include "../modules/footer.php"; ?>
</body>
</html>