<?php
include "../includes/db_config.php";
include "../includes/db.php";
require_once "../includes/session.php";
include "../modules/navbar.php";
include "../modules/footer.php";

$error = "";
$db = new Db();

if(isset($_POST['Add']) && isset($_SESSION['user_id'])){
    $title = $_POST['title'];
    $content = $_POST['content'];
    $acc_id = $_SESSION['user_id'];
    $username = $_SESSION['user_name'];

    if(isset($title) && isset($content)){
        $result = $db->query("INSERT INTO posts(title, content, acc_id) VALUES ('$title', '$content', '$acc_id')");
        header("location: author_blogs.php");
    }else{
        echo $error;
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>My Profile - Adding a Blog</title>
</head>

<body style=" padding-bottom: 10%; ">
<!--     <nav class="navbar navbar-default">
        <div class="container-fluid">
            <ul class="nav nav-tabs">
                <li role="presentation" class="">
                    <a href="#">Profile</a>
                </li>

                <li role="presentation" class="">
                    <a href="author_blogs.php"><span class="glyphicon glyphicon-list-alt"></span> My Blogs</a>
                </li>

                <li role="presentation" class="active">
                    <a href="profile.php"><span class="glyphicon glyphicon-plus"></span> Create a New Blog</a>
                </li>

                <li role="presentation" class="">
                    <a href="../logout.php"><span class="glyphicon glyphicon-log-out"></span> Logout</a>
                </li>
            </ul>
        </div>
    </nav> -->



    <div class="container-fluid">
        <div class="col-12 col-sm-3">

        </div>

        <div class="containter col-12 col-sm-9">
            <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post" name="blog-post">
                <div class="container-fluid">
                    <h4>Create a new blog</h4>
                    <p>Title: </p>
                    <input type="text" name="title" required>
                    <?php
                    if(isset($_POST['Add']) && isset($_SESSION['user_id'])){
                        if(empty($title)){
                            echo "<p><i>Please add a title.</i></p>";
                            echo $error;
                        }
                    } 
                    ?>

                    <br><br>

                    <p>Blog: </p>
                    <textarea name="content" cols="100" rows="15" placeholder="Enter text here..." required ></textarea>

                    <?php
                    if(isset($_POST['Add']) && isset($_SESSION['user_id'])){
                        if(empty($title)){
                            echo "<p><i>Empty content</i></p>";
                            echo $error;
                        }
                    } 
                    ?>
                </div>

                <div class="container-fluid">
                    <button type="submit" name="Add" class="btn btn-outline-dark">Add to Blog</button>
                </div>
            </form>
        </div>

    </div>



    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa"
    crossorigin="anonymous"></script>
</body>

</html>