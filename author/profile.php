<?php
include "../includes/db_config.php";
include "../includes/db.php";

session_start();

$error = "";
$db = new Db();

/**if (isset($_SESSION['user_id'])){
    echo "Welcome user ".$_SESSION['user_id'];
    #$acc_id = $_SESSION['user_id'];
}
**/

if(isset($_POST['Add']) && isset($_SESSION['user_id'])){
    $title = $_POST['title'];
    $content = $_POST['content'];
    $acc_id = $_SESSION['user_id'];
    $username = $_SESSION['user_name'];

    if(isset($title) && isset($content)){
        $result = $db->query("INSERT INTO posts(title, content, acc_id) VALUES ('$title', '$content', '$acc_id')");
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
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <title>My Profile - Adding a Blog</title>
</head>

<body>
    <nav class="navbar navbar-default">
        <div class="container-fluid">
            <ul class="nav nav-tabs">
                <li role="presentation" class="active">
                    <a href="#">Profile</a>
                </li>
            </ul>

        </div>
    </nav>

    <div class="container-fluid">
        <?php 
        if (isset($_SESSION['user_name'])){
            echo "<h3>Welcome author <b>".$_SESSION['user_name'] ."</b></h3>";
        }
        ?>
    </div>

    <div class="container-fluid">
        <div class="col-12 col-sm-3">

        </div>

        <div class="col-12 col-sm-9">
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
                    <input type="submit" name="Add" value="Add to Blog">
                </div>
            </form>
        </div>

    </div>



    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa"
    crossorigin="anonymous"></script>
</body>

</html>