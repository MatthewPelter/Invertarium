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
$usersqll = "SELECT * FROM user WHERE user_username='$user_username'";
$runsqll = mysqli_query($db_handle->conn, $usersqll);
$returnarr = mysqli_fetch_assoc($runsqll);

if ($returnarr['isVendor'] == "0") {


    if (isset($_POST['submit'])) {
        if (isset($_POST['vendor'])) {

        $insertsql = "INSERT INTO pendingvendor (username, userid, message) VALUES ('".$user_username."','".$returnarr['user_id']."','I wanna be a vendor')";
        $insertexe = mysqli_query($db_handle->conn, $insertsql);
        
        if ($insertexe) {
            echo "Submitted! We'll review your request asap!";
        } else {
            echo "Contact Web Developer: Something is broken";
            echo "Error: " . $sql . "<br>" . mysqli_error($db_handle->conn);
        }
        
        } else {
            echo "You need to check the box...";
        }
    
    } 

} else {
    die("You are a vendor already..");
}
?>

<?php
$vendorsql = "SELECT * FROM pendingvendor WHERE username='$user_username'";
$runvendorsql = mysqli_query($db_handle->conn, $vendorsql);
$returnvendor = mysqli_fetch_assoc($runvendorsql);

?>
<div id="product-grid">
	<div class="h1-style">Vendor Settings</div>
	
	<form method="post" enctype="multipart/form-data" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
      <input type="checkbox" name="vendor" value="Vendor" > Become Vendor<br>
      <input type="submit" name="submit" value="Submit">
    </form>
</div>	
	

<?php include("footer.php"); ?>
</BODY>
</HTML>