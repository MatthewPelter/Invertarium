<?php
    ini_set("display_errors",1);
    session_start();
    $temp=$_SESSION['user_username'];
    
    
    function securityscan($data) {
      $data = trim($data);
      $data = stripslashes($data);
      $data = htmlspecialchars($data);
      return $data;
    }
    
    if(isset($_POST['submit'])){
        require_once("../dbcontroller.php");
		$db_handle = new DBController();
        $Destination = '../userfiles/avatars';
        if(!isset($_FILES['ImageFile']) || !is_uploaded_file($_FILES['ImageFile']['tmp_name'])){
            $NewImageName= 'default.png';
            move_uploaded_file($_FILES['ImageFile']['tmp_name'], "$Destination/$NewImageName");
        }
        else{
            $RandomNum   = rand(0, 9999999999);
            $ImageName = str_replace(' ','-',strtolower($_FILES['ImageFile']['name']));
            $ImageType = $_FILES['ImageFile']['type'];
            $ImageExt = substr($ImageName, strrpos($ImageName, '.'));
            $ImageExt = str_replace('.','',$ImageExt);
            $ImageName = preg_replace("/\.[^.\s]{3,4}$/", "", $ImageName);
            $NewImageName = $ImageName.'-'.$RandomNum.'.'.$ImageExt;
            move_uploaded_file($_FILES['ImageFile']['tmp_name'], "$Destination/$NewImageName");
        }
        $sql5="UPDATE user SET user_avatar='$NewImageName' WHERE user_username = '$temp'";
        $sql6="INSERT INTO user (user_avatar) VALUES ('$NewImageName') WHERE user_username = '$temp'";
        $result = mysqli_query($db_handle->conn,"SELECT * FROM user WHERE user_username = '$temp'");
        if( mysqli_num_rows($result) > 0) {
            if(!empty($_FILES['ImageFile']['name'])){
                $imageer = mysqli_query($db_handle->conn,$sql5);
                if ($imageer) {
                    header("location:../edit-profile.php?user_username=$temp");
                } else {
                    echo "Error: " . $sql . "<br>" . mysqli_error($db_handle->conn);
                }
            }
        } 
        else {
            $imageeer = mysqli_query($db_handle->conn,$sql6);
            if ($imageeer) {
                header("location:../edit-profile.php?user_username=$temp");
            } else {
                echo "Error: " . $sql . "<br>" . mysqli_error($db_handle->conn);
            }
        }  
        $user_firstname = securityscan($_POST['user_firstname']);
        $user_lastname=securityscan($_POST['user_lastname']);
        $user_email=securityscan($_POST['user_email']);
        $user_profession=securityscan($_POST['user_profession']);
        $user_address=securityscan($_POST['user_address']);
        $user_website = securityscan($_POST['user_website']);
        $user_shortbio=securityscan($_POST['user_shortbio']);   
        $user_dob=securityscan($_POST['user_dob']);
        $user_gender=securityscan($_POST['user_gender']);
        $user_country=securityscan($_POST['country']);
        $sql3="UPDATE user SET user_firstname='$user_firstname',user_lastname='$user_lastname',user_location='$user_address',user_email='$user_email',user_shortbio='$user_shortbio',user_dob='$user_dob',user_gender='$user_gender',user_country='$user_country',user_website='$user_website' WHERE user_username = '$temp'";
            $sendder = mysqli_query($db_handle->conn,$sql3);
        if ($sendder) {
            header("location:../profile.php?user_name=$temp&request=profile-update&status=success");
        } else {
            echo "Error: " . $sql . "<br>" . mysqli_error($db_handle->conn);
        }
    }    
?>