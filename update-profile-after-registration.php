<?php require_once("dbcontroller.php");
$db_handle = new DBController();
include("header.php");
 ?>
        <div class="container" style="padding-top:100px;">
            <div class="no-gutter row">             
                <div class="col-md-12">
                     <center><h2 class="h1-style">Fill Up the details below to Continue</h2></center>
              	     <div class="panel panel-default" id="sidebar">
                        <div class="panel-body">
<?php
	$user_username = mysqli_real_escape_string($db_handle->conn,$_REQUEST['user_username']);
    $sql = "SELECT * FROM user where user_username='$user_username'";
    $result = mysqli_query($db_handle->conn,$sql) or die(mysqli_error($db_handle->conn)); 
    $rws = mysqli_fetch_array($result);
?>                
<?php include 'controllers/form/update-profile-after-registration-form.php' ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        
<?php include("footer.php"); ?>