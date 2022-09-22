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
<TITLE>Simple Shop by Q. Marshall</TITLE>
</HEAD>
<BODY>

<h1 class="h1-style">Animal Shop</h1>
</br>

<?php

	$product_array = $db_handle->runQuery("SELECT * FROM tblproduct WHERE code='".htmlspecialchars($_GET["item"])."'");
	if (!empty($product_array)) { 
		foreach($product_array as $key=>$value){
	?>
		<div class="product-item">
			<form method="post" action="messagevendor.php?item=<?php echo htmlspecialchars($_GET["item"]); ?>&vendor=<?php echo $product_array[$key]["vendorID"]; ?>">
			<div class="product-image"><img src="userfiles/product-images/<?php echo $product_array[$key]["image"]; ?>"></div>
			<div><strong>Species: <?php echo $product_array[$key]["species"]; ?></strong></div>
			<div>Category: <?php echo $product_array[$key]["category"]; ?></strong></div>
			<div>Gender: <?php echo $product_array[$key]["gender"]; ?></div>
			<div>Amount: <?php echo $product_array[$key]["itemamount"]; ?></div>
			<div>Description: <?php echo $product_array[$key]["descrip"]; ?></div>
			<div>Size: <?php echo $product_array[$key]["size"]; ?> inches</div>
			<div>Year of Birth: <?php echo $product_array[$key]["yob"]; ?></div>
			<div>Science Name: <?php echo $product_array[$key]["sciname"]; ?></div>
			<div>Common Name: <?php echo $product_array[$key]["comname"]; ?></div>
			<div>Feeding: <?php echo $product_array[$key]["feed"]; ?></div>
			<div>Age: <?php echo $product_array[$key]["age"]; ?></div>
			<div>Status: <?php echo $product_array[$key]["status"]; ?></div>
			<div class="product-price">Price: <?php echo "$".number_format($product_array[$key]["price"]); ?></div>
			</form>
		</div>
	<?php
			}
	}
?>

<h1 class="h1-style">Send a Message</h1>
<form action="send-message.php?receiver=<?php echo htmlspecialchars($_GET['vendor']); ?>&product=<?php echo htmlspecialchars($_GET['item']); ?>" id="f1" method="post">
        <textarea name="body" rows="8" cols="80"></textarea>
		</br>
        <input type="submit" name="send" value="Send Message">
</form>

<style type="text/css">

	.product-image img {
		height: 300px;
		width: auto;
	}

</style>

</BODY>

<?php include("footer.php"); ?>
</HTML>