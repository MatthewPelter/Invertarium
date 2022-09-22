<?php 
include 'components/authentication.php';    
include 'components/session-check.php'; 
include('classes/Mail.php');
include("header.php");
require_once("dbcontroller.php");
$db_handle = new DBController();

function securityscan($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}



$sql2 = "SELECT * FROM user where user_username='$user_username'";
$result2 = mysqli_query($db_handle->conn,$sql2) or die(mysqli_error($db_handle->conn));
$row = mysqli_fetch_assoc($result2);


if (!empty($_GET['makevendor'])) {
    $id = securityscan($_GET['makevendor']);
    
    $sql = "UPDATE user SET isVendor='1' WHERE user_id='$id'";
    $result = mysqli_query($db_handle->conn,$sql) or die(mysqli_error($db_handle->conn));
    
    $username = mysqli_query($db_handle->conn, "SELECT user_firstname, user_lastname FROM user WHERE user_id='$id'") or die(mysqli_error($db_handle->conn));
    $finalprod = mysqli_fetch_assoc($username);
	$omgfinalshit = implode(" ",$finalprod);
	
	$vendorname = "SELECT user_username FROM user WHERE user_id='$id'";
	$vendorresult = mysqli_query($db_handle->conn,$vendorname) or die(mysqli_error($db_handle->conn));
	$vendorprod = mysqli_fetch_assoc($vendorresult);
	$omgfinalvendor = implode("",$vendorprod);

    $add = "INSERT INTO vendors (user_id, user_username, name, datejoined) VALUES ('$id', '$omgfinalvendor', '$omgfinalshit', CURRENT_TIMESTAMP)";
    $addres = mysqli_query($db_handle->conn,$add) or die(mysqli_error($db_handle->conn));
    
    if ($result && $addres) {
        echo "Success";
    } else {
        echo "Error: Contact Web Developer";
    }
} else if (!empty($_GET['makeadmin'])) {
    $id = securityscan($_GET['makeadmin']);
    
    $sql = "UPDATE user SET isAdmin='1' WHERE user_id='$id'";
    $result = mysqli_query($db_handle->conn,$sql) or die(mysqli_error($db_handle->conn));
    
    if ($result) {
        echo "Success";
    } else {
        echo "Error: Contact Web Developer";
    }
} else if (!empty($_GET['removevendor'])) {
    $id = securityscan($_GET['removevendor']);
    
    $sql = "UPDATE user SET isVendor='0' WHERE user_id='$id'";
    $result = mysqli_query($db_handle->conn,$sql) or die(mysqli_error($db_handle->conn));
    
    $removevendor = "DELETE FROM vendors WHERE user_id='$id'";
    $removeresult = mysqli_query($db_handle->conn,$removevendor) or die(mysqli_error($db_handle->conn));
    
    if ($result && $removeresult) {
        echo "Success";
    } else {
        echo "Error: Contact Web Developer";
    }
} else if (!empty($_GET['removeadmin'])) {
    $id = securityscan($_GET['removeadmin']);
    
    $sql = "UPDATE user SET isAdmin='0' WHERE user_id='$id'";
    $result = mysqli_query($db_handle->conn,$sql) or die(mysqli_error($db_handle->conn));
    
    if ($result) {
        echo "Success";
    } else {
        echo "Error: Contact Web Developer";
    }
} else if (!empty($_GET['removeitems'])) {
    $id = securityscan($_GET['removeitems']);
    
    $sql = "DELETE FROM tblproduct WHERE vendorID='$id'";
    $result = mysqli_query($db_handle->conn,$sql) or die(mysqli_error($db_handle->conn));
    
    if ($result) {
        echo "Success";
    } else {
        echo "Error: Contact Web Developer";
    }
} else if (!empty($_GET['removemessages'])) {
    $id = securityscan($_GET['removemessages']);
    
    $sql = "DELETE FROM messages WHERE sender='$id' OR receiver='$id'";
    $result = mysqli_query($db_handle->conn,$sql) or die(mysqli_error($db_handle->conn));
    
    if ($result) {
        echo "Success";
    } else {
        echo "Error: Contact Web Developer";
    }
} else if (!empty($_GET['deleteuser'])) {
    $id = securityscan($_GET['deleteuser']);
    
    $sql = "DELETE FROM tblproduct WHERE vendorID='$id'";
    $result = mysqli_query($db_handle->conn,$sql) or die(mysqli_error($db_handle->conn));
    
    $sql2 = "DELETE FROM messages WHERE sender='$id' OR receiver='$id'";
    $result2 = mysqli_query($db_handle->conn,$sql2) or die(mysqli_error($db_handle->conn));
    
    $sql3 = "DELETE FROM user WHERE user_id='$id'";
    $result3 = mysqli_query($db_handle->conn,$sql3) or die(mysqli_error($db_handle->conn));
    
    if ($result && $result2 && $result3) {
        echo "Success";
    } else {
        echo "Error: Contact Web Developer";
    }
} else if (!empty($_GET['warnuser'])) {
    $id = securityscan($_GET['warnuser']);
    
    $sql = "SELECT user_email FROM user WHERE user_id='$id'";
    $result = mysqli_query($db_handle->conn,$sql) or die(mysqli_error($db_handle->conn));
    $finalprod = mysqli_fetch_assoc($result);
	$email = implode("",$finalprod);
    
    
    Mail::sendMail('Invertarium Notice', "You are receiving this email to alert you that you have received a warning for breaking the terms and conditions.", $email);
    
    if ($result) {
        echo "Success. They have been emailed!";
    } else {
        echo "Error: Contact Web Developer";
    }
}


if($row['isAdmin'] == "1") {
?>
	<div class="container">
	  <div class="row clearfix">
		  <div class="col-md-12 column">
			  <div class="row clearfix">
<?php
    
    $current_user = $_SESSION['user_username'];
    $sql = "SELECT * FROM user WHERE user_username != '$current_user' order by user_id desc";
    $result = mysqli_query($db_handle->conn,$sql) or die(mysqli_error($db_handle->conn));
	$rws = mysqli_fetch_array($result);
    foreach ($result as $userr){ 
	
?>
		<a class="box" href="profile.php?user_name=<?php echo $userr['user_username'];?>">
			<div class="userbox">
				<img src="userfiles/avatars/<?php echo $userr['user_avatar'];?>" name="aboutme" class="img-responsive"> 
				<div class="username">Username: <?php echo $userr['user_username']; ?></div>
				<div class="email">Email: <?php echo $userr['user_email']; ?></div>
				<div class="join">Join Date: <?php echo $userr['user_joindate']; ?></div>
				<div class="firstname">Firstname: <?php echo $userr['user_firstname']; ?></div>
				<div class="lastname">Lastname: <?php echo $userr['user_lastname']; ?></div>
				<div class="vendor" style="color:yellow;"><?php if ($userr['isVendor'] == "1") { echo "Vendor";} ?></div>
				<div class="admin" style="color:red;"><?php if ($userr['isAdmin'] == "1") { echo "Admin";} ?></div>
				<?php if ($userr['isVendor'] == "0") { ?>
				    <a class="btnn" href="all-users.php?makevendor=<?php echo $userr['user_id']; ?>">Make Vendor</a><br />
				<?php } else { ?>
				    <a class="btnn" href="all-users.php?removevendor=<?php echo $userr['user_id']; ?>">Remove Vendor</a><br />
				<?php } 
				    if ($userr['isAdmin'] == "0") { ?>
				    <a class="btnn" href="all-users.php?makeadmin=<?php echo $userr['user_id']; ?>">Make Admin</a><br />
				<?php } else { ?>    
				    <a class="btnn" href="all-users.php?removeadmin=<?php echo $userr['user_id']; ?>">Remove Admin</a><br />
				<?php } ?>
				
				<a class="btnn" href="all-users.php?removeitems=<?php echo $userr['user_id']; ?>">Remove all Items</a> <br />
				<a class="btnn" href="all-users.php?removemessages=<?php echo $userr['user_id']; ?>">Remove All Messages</a><br />
				<a class="btnn" style="background:#e74c3c !important;" href="all-users.php?deleteuser=<?php echo $userr['user_id']; ?>">Delete User</a><br />
				<a class="btnn" href="all-users.php?warnuser=<?php echo $userr['user_id']; ?>">Warn User</a>
			</div>
		</a>
		
 <?php } ?>                                                         
						  </div>
					  </div>
				  </div>
			  </div>
<?php 
} else {
	die("You're not admin. Sorry.");
}
?>
<style type="text/css">
	.box {
		text-decoration: none;
		color: #eee !important;
		font-size: 30px;
		font-family: 'Righteous';
	}
	.userbox {
		background: #37756a;
		padding: 20px;
		margin-left: 3px;
		margin-bottom: 3px;
		width: 33%;
		border-radius: 10px;
		transition: 200ms;
		text-align: center;
		text-decoration: none;
		float: left;
	}
	.box:hover .userbox {
		background: #2f4844;
	}
	.userbox img {
		height: 200px;
		width: auto;
		border-radius: 100px;
	}
	.userbox a.btnn {
	    display: block;
	    text-decoration: none;
	    background: #333;
	    color: #fff;
	    padding: 10px;
	}
</style>
<?php include("footer.php"); ?>