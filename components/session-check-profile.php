<?php
    session_start();
    require_once("./dbcontroller.php");
	$db_handle = new DBController();
    if(!$_SESSION['user_username']){
        header("location:$user_username");
        die();
    }
?>