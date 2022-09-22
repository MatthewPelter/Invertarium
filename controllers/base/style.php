<?php
    if (isset($_GET['user_name'])) {
        $user_name = $_GET['user_name'];
    }
    $sql = "SELECT * FROM user WHERE user_username='$user_name'";
    $result = mysqli_query($db_handle->conn,$sql) or die(mysqli_error($db_handle->conn)); 
    $rws = mysqli_fetch_array($result);       
?>