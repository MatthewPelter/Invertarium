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
    
    $sql = "SELECT * FROM vendors where user_username='$user_username'";
    $result = mysqli_query($db_handle->conn,$sql) or die(mysqli_error($db_handle->conn)); 
    $rws = mysqli_fetch_array($result);
    
    include 'controllers/form/edit-vendor-form.php';
?>

</BODY>
<?php include("footer.php"); ?>
</HTML>    