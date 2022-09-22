<?php
    ini_set("display_errors",1);
    session_start();
    $temp=$_SESSION['user_username'];
    
    
    function securityscan($data) {
      $data = trim($data);
      $data = stripslashes($data);
      $data = htmlspecialchars($data);
      $data = addslashes($data);
      return $data;
    }
    
    if(isset($_POST['submit'])){
        require_once("../dbcontroller.php");
		$db_handle = new DBController();

        $name = securityscan($_POST['name']);
        $about = securityscan($_POST['about']);
        $location = securityscan($_POST['location']);
        $terms = securityscan($_POST['terms']);
        $deliv = securityscan($_POST['deliv']);
        $shippingpolicy = securityscan($_POST['shippingpolicy']);   
        $website = securityscan($_POST['website']);
        
        $sql3="UPDATE vendors SET name='$name',about='$about',location='$location',terms='$terms',delivoption='$deliv',shippingpolicy='$shippingpolicy',website='$website' WHERE user_username = '$temp'";
            $sendder = mysqli_query($db_handle->conn,$sql3);
        if ($sendder) {
            header("location:../vendorprofile.php?vendor=$temp&status=success");
        } else {
            echo "Error: " . $sql . "<br>" . mysqli_error($db_handle->conn);
        }
    }    
?>