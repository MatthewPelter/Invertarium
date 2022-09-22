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
$category = $spec = $gender = $age = $amount = $desc = $size = $yob = $sciname = $feed = $price = $vendorID = $itemamount = $descslash = "";

function securityscan($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  $data = addslashes($data);
  return $data;
}

function createRandomCode() { 
    $chars = "abcdefghijkmnopqrstuvwxyzABCDEFGHIJKMNOPQRSTUVWXYZ0123456789"; 
    srand((double)microtime()*1000000); 
    $i = 0; 
    $pass = '' ; 
    while ($i <= 6) { 
        $num = rand() % 60; 
        $tmp = substr($chars, $num, 1); 
        $pass = $pass . $tmp; 
        $i++; 
    } 
    return $pass; 
} 

if (isset($_POST['submit'])) {
	$category = securityscan($_POST["cats"]);
	$spec = securityscan($_POST["spec"]);
	$age = securityscan($_POST["age"]);
	$gender = securityscan($_POST["gender"]);
	$desc = securityscan($_POST["desc"]);
	$descslash = addslashes($desc);
	$size = securityscan($_POST["size"]);
	$yob = securityscan($_POST["yob"]);
	$sciname = securityscan($_POST["sciname"]);
	$comname = securityscan($_POST["comname"]);
	$feed = securityscan($_POST["feed"]);
	$price = securityscan($_POST["price"]);
	$itemamount = securityscan($_POST["amount"]);
	$vendorID = $_SESSION['user_username'];
	
	$code = "SELECT user_id FROM user WHERE user_username='$vendorID'";
	$runshit = mysqli_query($db_handle->conn, $code);
	$finalprod = mysqli_fetch_assoc($runshit);
	$omgfinalshit = implode("",$finalprod);

	$Destination = 'userfiles/product-images';
        if(!isset($_FILES['ImageFile']) || !is_uploaded_file($_FILES['ImageFile']['tmp_name'])){
            $NewImageName= 'default.jpg';
            move_uploaded_file($_FILES['ImageFile']['tmp_name'], "$Destination/$NewImageName");
        }
        else{
            $RandomNum = rand(0, 9999999999);
            $ImageName = str_replace(' ','-',strtolower($_FILES['ImageFile']['name']));
            $ImageType = $_FILES['ImageFile']['type'];
            $ImageExt = substr($ImageName, strrpos($ImageName, '.'));
            $ImageExt = str_replace('.','',$ImageExt);
            $ImageName = preg_replace("/\.[^.\s]{3,4}$/", "", $ImageName);
            $NewImageName = $ImageName.'-'.$RandomNum.'.'.$ImageExt;
            move_uploaded_file($_FILES['ImageFile']['tmp_name'], "$Destination/$NewImageName");
        }
	
	
	
	
	$sql = "INSERT INTO tblproduct (species, code, price, category, gender, descrip, size, yob, sciname, comname, feed, age, image, vendorID, itemamount, status, posteddate) VALUES ('".$spec."','".createRandomCode()."','".$price."','".$category."','".$gender."','".$descslash."','".$size."','".$yob."','".$sciname."','".$comname."','".$feed."','".$age."','".$NewImageName."','".$omgfinalshit."','".$itemamount."','For Sale',CURRENT_TIMESTAMP)";
	
	if (mysqli_query($db_handle->conn, $sql)) {
		echo "Your Item has been Listed!!";
		
		$db_handle->conn->close();
		exit;
	} else {
		echo "Error: " . $sql . "<br>" . mysqli_error($db_handle->conn);
		echo "Somethins wrong STUUUPIIDIDDD";
	}
}


$sql2 = "SELECT * FROM user where user_username='$user_username'";
$result = mysqli_query($db_handle->conn,$sql2) or die(mysqli_error($db_handle->conn));
$row = mysqli_fetch_assoc($result);

$yeert = mysqli_query($db_handle->conn,"SELECT * FROM webcategories");
$yet = mysqli_fetch_assoc($yeert);


if ($row['isVendor'] == "1") {
?>
<h2 class="h1-style">List your Item</h2><br>
<form method="post" enctype="multipart/form-data" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">  
  Category: 
  <select name="cats">
      
    <?php 
        foreach ($yeert as $yoot) {
    ?>
	  <option value="<?php echo $yoot['category']; ?>"><?php echo ucfirst($yoot['category']); ?></option>
	  
	  <?php 
        }
	  ?>
  </select>
  <br><br>
  Species: <input type="text" name="spec">
  <br><br>
  Sex: 
  <input type="radio" name="gender" value="female" checked>Female
  <input type="radio" name="gender" value="male">Male
  <input type="radio" name="gender" value="unknown">Unknown
  <br><br>
  Age (Growth Stage): <input type="text" name="age">
  <br><br>
  # Available: <input type="text" name="amount">
  <br><br>
  Size (inches): <input type="text" name="size">
  <br><br>
  Birth Year: <input type="text" name="yob">
  <br><br>
  Scientific Name: <input type="text" name="sciname">
  <br><br>
  Common Name: <input type="text" name="comname">
  <br><br>
  Currently Feeding: <input type="text" name="feed">
  <br><br>
  Description: <br><textarea name="desc" rows="10" cols="70"></textarea>
  <br><br>
  Product Image: <input type="file" name="ImageFile" id="ImageFile">
  <br><br>
  Price: $<input type="text" name="price">
  <br><br>
  <input type="submit" name="submit" value="List">  
</form>
<?php
} else {
	echo "<div class='h3-style center'>You are not a vendor.</div>";
}
?>
</BODY>
<?php include("footer.php"); ?>
</HTML>

