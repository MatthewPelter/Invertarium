<?php
include 'components/authentication.php';
include("guestheader.php");
include('classes/Mail.php');
require_once("dbcontroller.php");
$db_handle = new DBController();
?>

<HTML>
<BODY>

<?php
if (isset($_GET['token'])) {
        $token = $_GET['token'];
        if (mysqli_query($db_handle->conn, "SELECT user_id FROM password_tokens WHERE token='".sha1($token)."'")) {
                $userid = mysqli_query($db_handle->conn, "SELECT user_id FROM password_tokens WHERE token='".sha1($token)."'");
                $finalprod = mysqli_fetch_assoc($userid);
	            $omgfinalshit = implode("",$finalprod);
	            
                $tokenIsValid = True;
                if (isset($_POST['changepassword'])) {
                        $newpassword = $_POST['newpassword'];
                        $newpasswordrepeat = $_POST['newpasswordrepeat'];
                                if ($newpassword == $newpasswordrepeat) {
                                        if (strlen($newpassword) >= 6 && strlen($newpassword) <= 60) {
                                            
                                                $passy = password_hash($newpassword, PASSWORD_BCRYPT);
                                            
                                                if (mysqli_query($db_handle->conn, "UPDATE user SET user_password='$passy' WHERE user_id='$omgfinalshit'")) {
                                                    echo 'Password changed successfully!';
                                                } else {
                                                    echo "Error: " . $sql . "<br>" . mysqli_error($db_handle->conn);
                                                }
                                                
                                                mysqli_query($db_handle->conn, "DELETE FROM password_tokens WHERE user_id='$omgfinalshit'");
                                        } else {
                                            echo 'Password is not long enough or too long!';
                                        }
                                } else {
                                        echo 'Passwords don\'t match!';
                                }
                }
        } else {
                die('Token invalid');
        }

}

?>




<h1>Change your Password</h1>
<form action="change-password.php?token=<?php echo $token; ?>" method="post">
        <input type="password" name="newpassword" value="" placeholder="New Password ..."><p />
        <input type="password" name="newpasswordrepeat" value="" placeholder="Repeat Password ..."><p />
        <input type="submit" name="changepassword" value="Change Password">
</form>


</BODY>
<?php include("footer.php"); ?>
</HTML>