<?php 
include 'components/authentication.php';
include 'components/session-check.php';
include("header.php");
require_once("dbcontroller.php");
$db_handle = new DBController();
?>
<HTML>
<HEAD>
</HEAD>
<BODY>

<h1 class="h1-style">Super Secret Admin Page</h1>

<?php 

function securityscan($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}

$sql = "SELECT * FROM websitesettings";
$result = mysqli_query($db_handle->conn, $sql);
$rws = mysqli_fetch_array($result);

if (isset($_POST['submitdescription'])) {
	$description = securityscan($_POST['desc']);
	$descslash = addslashes($description);
	
	$sql2 = "UPDATE websitesettings SET maintext='$descslash',editor='$user_username' WHERE id='1'";
	if (mysqli_query($db_handle->conn, $sql2)) {
		echo "Updated!!!";
			
		$db_handle->conn->close();
		exit;
	} else {
		echo "Something is fucked up <br>";
		echo "Error: " . $sql . "<br>" . mysqli_error($db_handle->conn);
	}
}

?>

<form method="post" enctype="multipart/form-data">
<br>
Homepage Description: <br><textarea name="desc" placeholder="<?php echo $rws['maintext']; ?>" value="<?php echo $rws['maintext']; ?>" rows="10" cols="70"><?php echo $rws['maintext']; ?></textarea>
<br />
Last Editor: <?php echo $rws['editor']; ?>
<br>

<input type="submit" name="submitdescription" value="Update">

</form>

</BODY>
</HTML>