<?php
session_start();
require_once("../class/class_login.php");
require_once("../inc/my_funcs.php");
require_once("../class/class_mysql_connect.php");

$connection=new MySql_Connection();
$connection->connect();

$username=$_POST['uname'];
$password=$_POST['pword'];
$login=new login();
$login->username=$username;

if ($login->searchByUsername()){
	if($login->retries<5){
		if($login->password==$password){
			$_SESSION['id']=$login->id;
			$_SESSION['username']=$login->username;
			$_SESSION['fullname']=$login->fullname;
			$_SESSION['user_type']=$login->user_type;
			$login->resetRetries();
			goHomePage();
			
		}else{
			$login->updateRetries();
			$_SESSION['errmsg']="Invalid Password <br/> Retries Left:".( 4-$login->retries);
			goLoginPage();
		}
	}else{
		goLoginPage();
		$_SESSION['errmsg']="Account is Blocked";
	}
}else{
	goLoginPage();
	$_SESSION['errmsg']="Account does not exist";
}	


?>