<?php
$db_handle = new DBController();
$sql = "SELECT * FROM user WHERE user_username='$user_username'";
$result = mysqli_query($db_handle->conn,$sql) or die(mysqli_error($db_handle->conn));
$row = mysqli_fetch_assoc($result);

$usid = $row['user_id'];
$not = "SELECT * FROM notifications WHERE receiver='$usid'";
$notres = mysqli_query($db_handle->conn,$not) or die(mysqli_error($db_handle->conn));
$rowres = mysqli_fetch_assoc($notres);

$usered = $rowres['sender'];

$usernot = "SELECT user_username FROM user WHERE user_id='$usered'";
$userres = mysqli_query($db_handle->conn,$usernot) or die(mysqli_error($db_handle->conn));
$usres = mysqli_fetch_assoc($userres);

if (!empty($notres)) {
    $notcount = "SELECT * FROM notifications WHERE receiver='$usid' AND type='0'";
    $num_rows = $db_handle->numRows($notcount);
}
?>