<?php
session_start();
require_once("../dbcontroller.php");
$db_handle = new DBController();
$user_username = $_SESSION['user_username'];

function securityscan($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  $data = addslashes($data);
  return $data;
}

$sql1 = "SELECT user_id FROM user WHERE user_username='$user_username'";
$result1 = mysqli_query($db_handle->conn, $sql1);
$finalprod = mysqli_fetch_assoc($result1);
$omgfinalshit = implode("",$finalprod);

if (isset($_GET['item'])) {
    
   $item = securityscan($_GET['item']); 
    if ($_GET['func'] == "add") {
        
        $sql = "INSERT INTO wishlist (user_id, product_id) VALUES ('".$omgfinalshit."', '".$item."')";
        $result = mysqli_query($db_handle->conn, $sql);
        
        if ($result) {
            header("location:/marshall/wishlist.php?status=success");
        } else {
            echo "Error: " . $sql . "<br>" . mysqli_error($db_handle->conn);
        }
    } else if ($_GET['func'] == "remove") {
    
        $sql = "DELETE FROM wishlist WHERE user_id='$omgfinalshit' AND product_id='$item'";
        $result = mysqli_query($db_handle->conn, $sql);
        
        if ($result) {
            header("location:/marshall/wishlist.php?status=success");
        } else {
            echo "Error: " . $sql . "<br>" . mysqli_error($db_handle->conn);
        }
    }
} else {
    echo "No item is selected!";
}




?>