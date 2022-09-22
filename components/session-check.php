<?php
    include('./classes/Login.php');
    require_once("./dbcontroller.php");
    $db_handle = new DBController();
    if (isset($_SESSION['user_username'])) {
            $userid = Login::isLoggedIn();
    } else {
        header("location:login.php?session=notset");
        die();
    }
?>