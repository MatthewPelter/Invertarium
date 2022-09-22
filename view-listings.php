<?php
include 'components/authentication.php';
include 'components/session-check.php';
//include 'controllers/base/head.php';
include("header.php");
require_once("dbcontroller.php");
$db_handle = new DBController();
?>

<HTML>
<HEAD>
<TITLE>Marshall's Fucking Shop</TITLE>
</HEAD>
<BODY>


<div id="product-grid">
	<div class="txt-heading">My Listings</div>
<?php
	$code = "SELECT user_id FROM user WHERE user_username='$user_username'";
	$runshit = mysqli_query($db_handle->conn, $code);
	$finalprod = mysqli_fetch_assoc($runshit);
	$omgfinalshit = implode("",$finalprod);
	
	$product_array = $db_handle->runQuery("SELECT * FROM tblproduct WHERE vendorID='".$omgfinalshit."' ORDER BY id ASC");
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
		echo "You Don't Have Anything Listed";
	}
?>


</div>




<style type="text/css">
.product-image img {
	height: 150px;
	width: auto;
}
</style>



<?php include("footer.php"); ?>
</BODY>
</HTML>