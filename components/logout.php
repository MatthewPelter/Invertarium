<?php
    session_start();
    require_once("../dbcontroller.php");
	$db_handle = new DBController();
	
	
	if (isset($_COOKIE['SNID'])) {
	    $tokenn = sha1($_COOKIE['SNID']);
        $deltoken = mysqli_query($db_handle->conn, "DELETE FROM login_tokens WHERE token='$tokenn'");
    }
    setcookie('SNID', '1', time()-3600);
    setcookie('SNID_', '1', time()-3600);
    
    
    session_destroy();
    header('location:../login.php?logout=success');
?>