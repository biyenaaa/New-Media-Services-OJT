<?php
include "../includes/db_config.php";
include "../includes/db.php";

$error = "";
$db = new Db();

if(isset($_POST['Add'])){
    $title = $_POST['title'];
    $content = $_POST['content'];

    if(empty($title) || empty($password)){
        if(empty($title)){
            echo "<p>Please add a title.</p>";
            echo $error;
        }

        if(empty($content)){
            echo "<p>Empty content</p>";
            echo $error;
        }
    }else{
        $result = $db->query("INSERT INTO posts(title, content, acc_id) VALUES ('$title', '$content', (SELECT acc_id FROM accounts WHERE username = 'lovelyn'))");
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
        <div class="col-12 col-sm-3">

        </div>

        <div class="col-12 col-sm-9">
            <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post" name="blog-post">
                <div class="container-fluid">
                    <p>Title: </p>
                    <input type="text" name="title">
                    
                    <br><br>

                    <p>Blog: </p>
                    <textarea name="content" cols="100" rows="15" placeholder="Enter text here..." ></textarea>
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