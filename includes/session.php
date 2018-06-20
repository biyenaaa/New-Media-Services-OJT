<?php
    include "db_config.php";
    include "db.php";
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
        else{
            header("Location:../login/login.php");
            exit;
        }
?>