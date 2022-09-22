<?php
    session_start();
    include('./classes/Login.php');
    require_once("dbcontroller.php");
    if(isset($_SESSION['user_username'])) { 
        header("location:home.php");
        die();
    }
?>
