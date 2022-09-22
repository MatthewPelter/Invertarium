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
    function securityscan($data) {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        $data = addslashes($data);
        return $data;
    }

    if (isset($_POST['resetpassword'])) {
        $cstrong = True;
        $token = bin2hex(openssl_random_pseudo_bytes(64, $cstrong));
        $email = securityscan($_POST['email']);
        $user_id = mysqli_query($db_handle->conn, "SELECT user_id FROM user WHERE user_email='$email'");
        $finalprod = mysqli_fetch_assoc($user_id);
        $omgfinalshit = implode("",$finalprod);
        
        mysqli_query($db_handle->conn, "INSERT INTO password_tokens (token, user_id) VALUES ('".sha1($token)."', '".$omgfinalshit."')");
        Mail::sendMail('Forgot Password!', "Click here to change your password. <a href='https://invertarium.net/marshall/change-password.php?token=$token'>https://invertarium.net/marshall/change-password.php?token=$token</a>", $email);
        echo 'Email sent!';
    }
?>
<h1 class="h1-style">Forgot Password</h1><br />
<form action="forgot-password.php" method="post">
        <input type="text" name="email" value="" placeholder="Email ..."><p />
        <input type="submit" name="resetpassword" value="Reset Password">
</form>
    
    
</BODY>
<?php include("footer.php"); ?>
</HTML>