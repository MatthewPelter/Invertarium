<?php
    session_start();
    require_once("./dbcontroller.php");
	$db_handle = new DBController();
	$user_username = $_SESSION['user_username'];
?>