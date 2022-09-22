<?php

class Login {
        public static function isLoggedIn() {
            $db_handle = new DBController();
                if (isset($_COOKIE['SNID'])) {
                    
                    $token = sha1($_COOKIE['SNID']);
                    $sql = "SELECT user_id FROM login_tokens WHERE token='$token'";
                    $checkfunction = mysqli_query($db_handle->conn,$sql);
                    $useridrip = mysqli_fetch_assoc($checkfunction);
                    $userid = implode("",$useridrip);
                    
                        if ($checkfunction) {
		                        
                                if (isset($_COOKIE['SNID_'])) {
                                    return $userid;   
                                } else {
                                    $cstrong = True;
                                    $token = bin2hex(openssl_random_pseudo_bytes(64, $cstrong));
                                    $tokeyy = sha1($token);
                                    $instoken = mysqli_query($db_handle->conn, "INSERT INTO login_tokens (token, user_id) VALUES ('".$tokeyy."', '".$userid."')"); 
                                    $deltoken = mysqli_query($db_handle->conn,"DELETE FROM login_tokens WHERE token='$token'");
                                    setcookie("SNID", $token, time() + 60 * 60 * 24 * 7, '/', NULL, NULL, TRUE);
                                    setcookie("SNID_", '1', time() + 60 * 60 * 24 * 3, '/', NULL, NULL, TRUE);
                                    return $userid;

                                }
                        }
                }
                return false;
        }
}
?>