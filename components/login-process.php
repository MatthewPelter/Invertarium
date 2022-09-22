<?php
    session_start();
	
    if(isset($_REQUEST['login_button'])||$_REQUEST['auto']==1){
        require_once("../dbcontroller.php");
		$db_handle = new DBController();
        $errmsg_arr = array();
        $errflag = false;
        $username=  mysqli_real_escape_string($db_handle->conn,$_REQUEST['username']);
        $password=  mysqli_real_escape_string($db_handle->conn,$_REQUEST['password']);
		
		/*
		function getUserIpAddr(){
			if(!empty($_SERVER['HTTP_CLIENT_IP'])){
				$ip = $_SERVER['HTTP_CLIENT_IP'];
			}elseif(!empty($_SERVER['HTTP_X_FORWARDED_FOR'])){
				$ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
			}else{
				$ip = $_SERVER['REMOTE_ADDR'];
			}
			return $ip;
		}
		*/
        if($username == '') {
            $errmsg_arr[] = 'Username missing';
            $errflag = true;
        }
        if($password == '') {
            $errmsg_arr[] = 'Password missing';
            $errflag = true;
        }
        if($errflag) {
            $_SESSION['ERRMSG_ARR'] = $errmsg_arr;
            session_write_close();
            header("location: authentication-check.php");
            exit();
        }
        $sql="SELECT user_username FROM user WHERE user_username='$username'";
        $result = mysqli_query($db_handle->conn,$sql) or die(mysqli_errno());
        $trws= mysqli_num_rows($result);
		
		$sql2 = "SELECT user_password FROM user WHERE user_username='$username'";
		$runpass = mysqli_query($db_handle->conn,$sql2) or die(mysqli_errno());
		$resultpass = mysqli_fetch_assoc($runpass);
		$omgfinal = implode("",$resultpass);
		
			if (password_verify($password, $omgfinal)) {
				$rws =  mysqli_fetch_array($result);
				$_SESSION['user_username']=$rws['user_username'];
				$_SESSION['user_password']=$rws['user_password'];
				$sql3 = "UPDATE user SET ipaddress='".getUserIpAddr()."' WHERE user_username='".$rws['user_username']."'";
				$iplog = mysqli_query($db_handle->conn,$sql3) or die(mysqli_errno());
				$cstrong = True;
                $token = bin2hex(openssl_random_pseudo_bytes(64, $cstrong));
                
                
                $user_idsql = mysqli_query($db_handle->conn, "SELECT user_id FROM user WHERE user_username='$username'");
                $useridrip = mysqli_fetch_assoc($user_idsql);
		        $user_id = implode("",$useridrip);
		        
		        $tokey = sha1($token);
		        
                $inserttoken = mysqli_query($db_handle->conn, "INSERT INTO login_tokens (token, user_id) VALUES ('".$tokey."','".$user_id."')"); //, array(':token'=>sha1($token), ':user_id'=>$user_id));
                
                
                //setcookie("SNID", $token, time() + 60 * 60 * 24 * 7, '/', NULL, NULL, TRUE);
                //setcookie("SNID_", '1', time() + 60 * 60 * 24 * 3, '/', NULL, NULL, TRUE);
				header("location:../home.php?user_username=$username&request=login&status=success");   
				
				
			} else {
				$errmsg_arr[] = 'user name and password not found';
			$errflag = true;
			if($errflag) {
				$_SESSION['ERRMSG_ARR'] = $errmsg_arr;
				session_write_close();
				header("location: ../components/authentication-check.php");
				exit();
			}
		}
    }
?>