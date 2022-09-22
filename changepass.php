<?php
include 'components/authentication.php';
include 'components/session-check.php';
include("header.php");
require_once("dbcontroller.php");
$db_handle = new DBController();
?>

<HTML>
<BODY>
<?php
    $sql = "SELECT * FROM user WHERE user_username='$user_username'";
    $result = mysqli_query($db_handle->conn,$sql) or die(mysqli_error($db_handle->conn)); 
    $rws = mysqli_fetch_array($result); 
    
    function securityscan($data) {
      $data = trim($data);
      $data = stripslashes($data);
      $data = htmlspecialchars($data);
      $data = addslashes($data);
      return $data;
    }
    
    if (isset($_POST['submit'])) {
        $currentpass = securityscan($_POST['currentpass']);
        $actualpass = $rws['user_password'];
        $newpass = securityscan($_POST['newpass']);
        $repeatpass = securityscan($_POST['newpassagain']);
        
        if (password_verify($currentpass, $actualpass)) {
            if ($newpass == $repeatpass && $currentpass != $newpass) {
                $updatepassword = password_hash($newpass, PASSWORD_BCRYPT);;
                $sql2 = "UPDATE user SET user_password='$updatepassword' WHERE user_username='$user_username'";
                $result2 = mysqli_query($db_handle->conn,$sql2) or die(mysqli_error($db_handle->conn));
                if ($result2) {
                    echo "New Password Set!";
                } else {
                    echo "Something Broke. Contact Web Developer.";
                }
            } else {
                die("New passwords do not match or Password is the same!");
            }
        } else {
            die("You entered a wrong password!");
        }
    }
    
?>
    
    
<form method="post" enctype="multipart/form-data" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">  
  <h1 class="h1-style">Change Password</h1><br />
  Current Password: <input type="password" name="currentpass" required>
  <br><br>
  New Password: <input type="password" name="newpass" required>
  <br><br>
  New Password Again: <input type="password" name="newpassagain" required>
  <br><br>
  <input type="submit" name="submit" value="Reset Password">  
</form>
    
</BODY>
<?php include("footer.php"); ?>
</HTML>