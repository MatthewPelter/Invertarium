<?php 
include 'components/authentication.php';
include 'components/session-check.php';
include("header.php");
          
    $sql = "SELECT * FROM user where user_username='$user_username'";
    $result = mysqli_query($db_handle->conn,$sql) or die(mysqli_error($db_handle->conn)); 
    $rws = mysqli_fetch_array($result);

include 'controllers/form/edit-profile-form.php';
include("footer.php"); 
?>