<?php
include "includes/db_config.php";
include "includes/db.php";

#include "modules/navbar.php";
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

$db = new Db();
$result = $db->query("SELECT p.post_id, a.username, p.title, p.date_published, p.content FROM accounts as a NATURAL JOIN posts as p WHERE p.status = 1 ORDER BY date_published DESC;");

?>

<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <meta http-equiv="X-UA-Compatible" content="ie=edge">
      <link rel="icon" href="style/images/logo.png">
      <link rel="stylesheet" href="style/style.css">
      <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
      <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
      <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  </head>
<body style="bottom-padding:10%">
  <div class="navig"> 
      <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <?php
        if(isset($acc_type)){
          if($acc_type=="0"){
            echo '<a class="navbar-brand" href="index.php">Blog & White</a>';
          }
          else{
            echo '<a class="navbar-brand" href="admin/homepage.php">Blog & White</a>';
          }
        }
        else{
            echo '<a class="navbar-brand" href="index.php">Blog & White</a>';
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
                    <a class="nav-link" href="author/author_blogs.php"> My Blogs <span class="sr-only">(current)</span></a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" href="author/create_blogs.php"> Write a Blog <span class="sr-only">(current)</span></a>
                  </li>';
                }
                if(isset($checkUser)and$acc_type=='1'){
                  echo '
                  <li class="nav-item active">
                    <a class="nav-link" href="admin/homepage.php"> Admin <span class="sr-only">(current)</span></a>
                  </li>
                  <li class="nav-item active">
                    <a class="nav-link" href="admin/blogs.php">Blogs <span class="sr-only">(current)</span></a>
                  </li>
                  <li class="nav-item active">
                    <a class="nav-link" href="admin/authors.php"> Authors <span class="sr-only">(current)</span></a>
                  </li>
                  <li class="nav-item active">
                    <a class="nav-link" href="admin/comments.php"> Comments <span class="sr-only">(current)</span></a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" href="author/author_blogs.php"> My Blogs <span class="sr-only">(current)</span></a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" href="author/create_blogs.php"> Create Blog <span class="sr-only">(current)</span></a>
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
                  <a href="logout.php">
                    <button type="button" class="btn btn-sm">
                        <span class="glyphicon glyphicon-log-out">Log out</span> 
                    </button>
                  </a>
                ';}
                else{
                  echo '
                  <a href="login/login.php">
                    <button type="button" class="btn btn-sm">
                        <span class="glyphicon glyphicon-log-in">Sign in</span> 
                    </button>
                  </a>
                  <div class="divider"></div>
                  <a href="registration/register.php">
                    <button type="button" class="btn btn-sm">
                        <span class="glyphicon glyphicon-log-out">Sign up</span> 
                    </button>
                  </a>';
                }
            ?>
        </div>
      </nav>
    </div>


  <div class="jumbotron p-3 p-md-5 text-white rounded bg-dark">
    <div class="col-md-12 px-0 headerblog">
      <h1 class="display-4 font-italic">Blog&White</h1>
      <p class="lead my-3">Share. Relive. Experience.</p>

    </div>
  </div>

  <main role="main" class="container">
    <div class="row">

      <div class="container-fluid">
        <h4>Latest Blogs</h4>

        <?php
        function limitTextWords($words = false, $limit = false, $stripTags = false, $ellipsis = false) 
        {
          if ($words && $limit) {
            $words = ($stripTags ? strip_tags($words) : $words);
            $ellipsis = ($ellipsis ? "..." : $ellipsis);
            $words  = mb_strimwidth($words, 0, $limit, $ellipsis);

          }
          return $words;
        }



        ?>
        <form action="post/getpost.php" method="GET">

          <div class="row mb-2">
            <input type="hidden" name="post_id" value="'.$postid.'">
            <?php
            while($row = mysqli_fetch_array($result)) {
              $title = $row['title'];
              $username = $row['username'];
              $date_published = $row['date_published'];
              $postid = $row['post_id'];
              $content = $row['content'];



              $output = '


              <div class="col-md-6">
              <div class="card flex-md-row mb-4 box-shadow h-md-250">
              <div class="card-body d-flex flex-column align-items-start">
              <strong class="d-inline-block mb-2 text-primary">'.$username.'</strong>
              <h3 class="mb-0">
              <a href=post/getpost.php?post_id='.$postid.' class="text-dark">'.$title.'</a>
              </h3>
              <div class="mb-1 text-muted">'.$date_published.'</div>
              <p class="card-text mb-auto">'.limitTextWords($content, 50, true, true).'</p>
              <form action="post/getpost.php" method="GET">
              <input type="hidden" name="post_id" value="'.$postid.'">
              <button type="submit" class="btn btn-outline-dark">Continue Reading</a>
              </form>
              </div>
              </div>
              </div>




              ';

              print("$output");
            }
            ?>
          </div>
        </div></div></main></form>
        <!--End of container-fluid-->

        <?php include "modules/footer.php"; ?>
        
        <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js" integrity="sha384-smHYKdLADwkXOn1EmN1qk/HfnUcbVRZyYmZ4qpPea6sjB/pTJ0euyQp0Mk8ck+5T" crossorigin="anonymous"></script>

      </body>
      </html>
