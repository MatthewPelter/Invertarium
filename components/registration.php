<?php
    session_start();
    require_once("../dbcontroller.php");
	$db_handle = new DBController();
	
	function securityscan($data) {
	  $data = trim($data);
	  $data = stripslashes($data);
	  $data = htmlspecialchars($data);
	  return $data;
	}
	
	
    if(isset($_REQUEST['signup_button'])){
        $user_email = securityscan($_REQUEST['user_email']);
        $user_firstname = securityscan($_REQUEST['user_firstname']);
        $user_lastname = securityscan($_REQUEST['user_lastname']);
        $user_username = securityscan($_REQUEST['user_username']);
        $user_password = securityscan($_REQUEST['user_password']);
		$AokidgAawT = password_hash($user_password, PASSWORD_BCRYPT);
        $sql="INSERT INTO user(user_firstname,user_lastname,user_email,user_username,user_password,user_joindate,user_avatar,user_backgroundpicture, isVendor, isAdmin) VALUES('$user_firstname','$user_lastname','$user_email','$user_username','$AokidgAawT',CURRENT_TIMESTAMP,'default.jpg','../userfiles/background-images','0','0')";
        mysqli_query($db_handle->conn,$sql) or die(mysqli_error($db_handle->conn));
        $_SESSION['user_username'] = $user_username;
        //header('Location: ../update-profile-after-registration.php?user_username='.$user_username);
        header('Location: ../home.php');
    }
?>