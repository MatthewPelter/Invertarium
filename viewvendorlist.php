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
$vendorid = securityscan($_GET['vendor']);
$code = "SELECT user_username FROM user WHERE user_id='$vendorid'";
$runshit = mysqli_query($db_handle->conn, $code);
$finalprod = mysqli_fetch_assoc($runshit);
$omgfinalshit = implode("",$finalprod);
?>



<h1 class="h1-style"><?php echo $omgfinalshit; ?>'s Items</h1>

<?php 
function securityscan($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}


	$product_array = $db_handle->runQuery("SELECT * FROM tblproduct WHERE vendorID='".$vendorid."' ORDER BY id ASC");
	if (!empty($product_array)) { 
		foreach($product_array as $key=>$value){
?>
		<div class="product-item">
			<div class="product-image"><img src="userfiles/product-images/<?php echo $product_array[$key]["image"]; ?>"></div>
			<div><strong><a href="product.php?item=<?php echo $product_array[$key]["code"]; ?>"><?php echo $product_array[$key]["species"]; ?></a></strong></div>
			<div class="product-price"><?php echo "$".number_format($product_array[$key]["price"]); ?></div>
		</div>
<?php
		}
			
	} else {
		echo $omgfinalshit . " Doesnt Have Anything Listed Yet";
	}
?>




<style type="text/css">
.product-image img {
	height: 150px;
	width: auto;
}
</style>





</BODY>
<?php include("footer.php"); ?>
</HTML>