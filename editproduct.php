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

<h1 class="h1-style">Edit Product</h1>

<?php
function securityscan($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}


if (isset($_POST['submit'])) {
	$category = securityscan($_POST["cats"]);
	$spec = securityscan($_POST["spec"]);
	$age = securityscan($_POST["age"]);
	$gender = securityscan($_POST["gender"]);
	$desc = securityscan($_POST["desc"]);
	$size = securityscan($_POST["size"]);
	$yob = securityscan($_POST["yob"]);
	$sciname = securityscan($_POST["sciname"]);
	$comname = securityscan($_POST["comname"]);
	$feed = securityscan($_POST["feed"]);
	$price = securityscan($_POST["price"]);
	$itemamount = securityscan($_POST["amount"]);
	$statuss = securityscan($_POST["stats"]);
	$vendorID = $_SESSION['user_username'];
	$itemy = securityscan($_GET["item"]);
	
	if ($statuss != "sold") {
	
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
		
		
		
		
		$sql = "UPDATE tblproduct SET species='$spec', price='$price', category='$category', gender='$gender', descrip='$desc', size='$size', yob='$yob', sciname='$sciname', comname='$comname', feed='$feed', age='$age', image='$NewImageName', itemamount='$itemamount', status='$statuss' WHERE code='$itemy'";
		
		if (mysqli_query($db_handle->conn, $sql)) {
			echo "Successfully Updated!";
			
			$db_handle->conn->close();
			exit;
		} else {
			echo "Error: " . $sql . "<br>" . mysqli_error($db_handle->conn);
			echo "Somethins wrong STUUUPIIDIDDD";
		}
		
	} else {
		if (mysqli_query($db_handle->conn, "DELETE FROM tblproduct WHERE code='".htmlspecialchars($_GET["item"])."'")) {
			echo "Item Sold and has been removed!";
			
			$db_handle->conn->close();
			exit;
		} else {
			echo "Error: " . $sql . "<br>" . mysqli_error($db_handle->conn);
			echo "Somethins wrong STUUUPIIDIDDD";
		}
	}

}

	$product_array = $db_handle->runQuery("SELECT * FROM tblproduct WHERE code='".htmlspecialchars($_GET["item"])."'");
	
	if (!empty($product_array)) { 
		foreach($product_array as $key=>$value){
			$idtousername = $product_array[$key]["vendorID"];	
			$code = "SELECT user_username FROM user WHERE user_id='$idtousername'";
			$runshit = mysqli_query($db_handle->conn, $code);
			$finalprod = mysqli_fetch_assoc($runshit);
			$omgfinalshit = implode("",$finalprod);
			
			if ($omgfinalshit == $user_username) {
?>
<form method="post" enctype="multipart/form-data">  
  Category: 
  <select name="cats" value="<?php echo $product_array[$key]["category"]; ?>">
	  <option value="tarantulas">Tarantulas</option>
	  <option value="scorpions">Scorpions</option>
	  <option value="truespiders">True Spiders</option>
	  <option value="mantids">Mantids</option>
	  <option value="myriapoda">Myriapoda</option>
	  <option value="ants">Ants</option>
	  <option value="feeders">Feeders</option>
	  <option value="other">Other Inverts</option>
	  <option value="supplies">Supplies</option>
  </select>
  <br><br>
  Species: <input type="text" placeholder="<?php echo $product_array[$key]["species"]; ?>" value="<?php echo $product_array[$key]["species"]; ?>" name="spec">
  <br><br>
  Sex: 
  <input type="radio" name="gender" value="female" checked>Female
  <input type="radio" name="gender" value="male">Male
  <br><br>
  Age (Growth Stage): <input type="text" placeholder="<?php echo $product_array[$key]["age"]; ?>" value="<?php echo $product_array[$key]["age"]; ?>" name="age">
  <br><br>
  # Available: <input type="text" placeholder="<?php echo $product_array[$key]["itemamount"]; ?>" value="<?php echo $product_array[$key]["itemamount"]; ?>" name="amount">
  <br><br>
  Size (inches): <input type="text" placeholder="<?php echo $product_array[$key]["size"]; ?>" value="<?php echo $product_array[$key]["size"]; ?>" name="size">
  <br><br>
  Birth Year: <input type="text" placeholder="<?php echo $product_array[$key]["yob"]; ?>" value="<?php echo $product_array[$key]["yob"]; ?>" name="yob">
  <br><br>
  Scientific Name: <input type="text" placeholder="<?php echo $product_array[$key]["sciname"]; ?>" value="<?php echo $product_array[$key]["sciname"]; ?>" name="sciname">
  <br><br>
  Common Name: <input type="text" placeholder="<?php echo $product_array[$key]["comname"]; ?>" value="<?php echo $product_array[$key]["comname"]; ?>" name="comname">
  <br><br>
  Currently Feeding: <input type="text" placeholder="<?php echo $product_array[$key]["feed"]; ?>" value="<?php echo $product_array[$key]["feed"]; ?>" name="feed">
  <br><br>
  Description: <br><textarea name="desc" placeholder="<?php echo $product_array[$key]["descrip"]; ?>" value="<?php echo $product_array[$key]["descrip"]; ?>" rows="10" cols="70"></textarea>
  <br><br>
  Product Image: <input type="file" name="ImageFile" id="ImageFile">
  <br>
  Current Image: <br><img style="width:200px;height:200px;" src="userfiles/product-images/<?php echo $product_array[$key]["image"]; ?>">
  <br><br>
  Price: $<input type="text" placeholder="<?php echo $product_array[$key]["price"]; ?>" value="<?php echo $product_array[$key]["price"]; ?>" name="price">
  <br><br>
  Status: 
  <select name="stats" value="<?php echo $product_array[$key]["status"]; ?>">
	  <option value="forsale">For Sale</option>
	  <option value="sold">Sold</option>
	  <option value="hold">On Hold</option>
  </select>
  <br><br>
  <input type="submit" name="submit" value="Update">   
</form>
				
<?php	
			} else {
				die("This is not your product!");
			}
			
		}
	}
?>


</BODY>
<?php include("footer.php"); ?>
</HTML>