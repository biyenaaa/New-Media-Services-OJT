<?php
    require "db_config.php";
    session_start();

    if(!isset($_SESSION['acc_id'])){
        $checkUser = $_SESSION['acc_id'];

        $sessionSql = mysqli_query($connection, "SELECT `acc_id`, `username`, `email`, `password`, `acc_type`, `date_registered`, `status` FROM `accounts` where username = '$checkUser'");
        $row = mysqli_fetch_array($sessionSql, MYSQLI_ASSOC);
        $session_user = $row['name'];
        $acc_id = $row['acc_id'];
        $username = $row['username'];
        $acc_type = $row['email'];
        $password = $row['password'];
        $acc_type = $row['acc_type'];
        $date_registered = $row['date_registered'];
        $status = $row['status'];
   }
?>