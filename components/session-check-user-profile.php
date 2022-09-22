<?php
    session_start();
    require_once("./dbcontroller.php");
	$db_handle = new DBController();
	$current_user = $_SESSION['user_username'];
    $user_username = mysqli_real_escape_string($db_handle->conn,$_REQUEST['user_username']);
	header("location:profile.php?user_name=$user_username&current_user=$current_user");
    die();
?>