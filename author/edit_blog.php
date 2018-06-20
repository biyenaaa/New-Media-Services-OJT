<?php
include "../includes/db_config.php";
include "../includes/db.php";
require_once "../includes/session.php";


$error = "";
$db = new Db();

if(isset($_POST['update'])){
	$id = $_POST['id'];
	die("<pre>".print_r($id)."</pre>");

}
$id = $_GET['id'];
	die("<pre>".print_r($id)."</pre>");

?>

<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<body>
	<form name="edit"></form>

</body>
</html>