<?php
include 'components/authentication.php';
include 'components/session-check.php';
include 'controllers/base/head.php';
//include 'controllers/navigation/first-navigation.php';
include("header.php");
require_once("dbcontroller.php");
$db_handle = new DBController();

?>
<HTML>
<HEAD>
<TITLE>Simple Shop by Q. Marshall</TITLE>
<!--<link href="style.css" type="text/css" rel="stylesheet" />-->
</HEAD>
<BODY>
<?php
$sql = "SELECT * FROM user where user_username='$user_username'";
$result = mysqli_query($db_handle->conn,$sql) or die(mysqli_error($db_handle->conn));
$row = mysqli_fetch_assoc($result);
?>


<div id="product-grid">
	<?php
	/*
	$product_array = $db_handle->runQuery("SELECT * FROM tblproduct ORDER BY id ASC");
	if (!empty($product_array)) { 
		foreach($product_array as $key=>$value){
	?>
		<div class="product-item">
			<form method="post" action="index.php?action=add&code=<?php echo $product_array[$key]["code"]; ?>">
			<div class="product-image"><img src="<?php echo $product_array[$key]["image"]; ?>"></div>
			<div><strong><a href="product.php?item=<?php echo $product_array[$key]["code"]; ?>"><?php echo $product_array[$key]["species"]; ?></a></strong></div>
			<div class="product-price"><?php echo "$".number_format($product_array[$key]["price"]); ?></div>
			<div><input type="text" name="quantity" value="1" size="2" /><input type="submit" value="Add to cart" class="btnAddAction" /></div>
			</form>
		</div>
	<?php
			}
	}
	*/
	?>
	
	<div class="categories">
		<a href="items.php?category=tarantulas"><div class="invertcat cat-t"><span class="cattext">Tarantulas</span></div></a>
		<a href="items.php?category=scorpions"><div class="invertcat cat-scorp"><span class="cattext">Scorpions</span></div></a>
		<a href="items.php?category=truespiders"><div class="invertcat cat-spider"><span class="cattext">True Spiders</span></div></a>
		<a href="items.php?category=mantids"><div class="invertcat cat-mantis"><span class="cattext">Mantids</span></div></a>
		<a href="items.php?category=myriapoda"><div class="invertcat cat-pede"><span class="cattext">Myriapoda</span></div></a>
		<a href="items.php?category=ants"><div class="invertcat cat-ant"><span class="cattext">Ants</span></div></a>
		<a href="items.php?category=feeders"><div class="invertcat cat-feed"><span class="cattext">Feeders</span></div></a>
		<a href="items.php?category=otherinverts"><div class="invertcat cat-other"><span class="cattext">Other Inverts</span></div></a>
		<a href="items.php?category=supplies"><div class="invertcat cat-supply"><span class="cattext">Supplies</span></div></a>
	</div>
	
	
</div>


<style type="text/css">

	#product-grid {
		text-align: center;
	}

	.product-image img {
		height: 100px ;
		width: auto;
		display: block;
	}
</style>
</BODY>
</HTML>
<?php include("footer.php"); ?>
