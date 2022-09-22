<?php 
include 'components/authentication.php';
include 'components/session-check.php';
include("header.php");
require_once("dbcontroller.php");
$db_handle = new DBController();
?>

<HTML>
<HEAD>
<style>
table.GeneratedTable {
  width: 700px;
  background-color: #ffffff;
  border-collapse: collapse;
  border-width: 2px;
  border-color: #629d81;
  border-style: groove;
  color: #000000;
}

table.GeneratedTable td, table.GeneratedTable th {
  border-width: 2px;
  border-color: #629d81;
  border-style: groove;
  padding: 10px;
}

table.GeneratedTable thead {
  background-color: #66997d;
}
</style>
</HEAD>
<BODY>

<div class="h1-style center">Product</div>

<?php

	$product_array = $db_handle->runQuery("SELECT * FROM tblproduct WHERE code='".htmlspecialchars($_GET["item"])."'");
	
	if (!empty($product_array)) { 
		foreach($product_array as $key=>$value){
			
		$idtousername = $product_array[$key]["vendorID"];	
		$code = "SELECT user_username FROM user WHERE user_id='$idtousername'";
		$runshit = mysqli_query($db_handle->conn, $code);
		$finalprod = mysqli_fetch_assoc($runshit);
		$omgfinalshit = implode("",$finalprod);
	?>
<div class="h3-style center product-item">
			
<div class="product-image"><img src="userfiles/product-images/<?php echo $product_array[$key]["image"]; ?>"></div>
<table class="GeneratedTable">
    <thead>
    <tr>
      <th>Info</th>
      <th>Details</th>
    </tr>
  </thead>
  <tbody>
    <tr>
      <td>Species</td>
      <td><?php echo $product_array[$key]['species']; ?></td>
    </tr>
    <tr>
      <td>Category</td>
      <td><?php echo $product_array[$key]['category']; ?></td>
    </tr>
    <tr>
      <td>Gender</td>
      <td><?php echo $product_array[$key]['gender']; ?></td>
    </tr>
    <tr>
      <td>Description</td>
      <td><?php echo $product_array[$key]['descrip']; ?></td>
    </tr>
    <tr>
      <td>Size</td>
      <td><?php echo $product_array[$key]['size']; ?> inches</td>
    </tr>
    <tr>
      <td>Year of Birth</td>
      <td><?php echo $product_array[$key]['yob']; ?></td>
    </tr>
    <tr>
      <td>Science name</td>
      <td><?php echo $product_array[$key]['sciname']; ?></td>
    </tr>
    <tr>
      <td>Common name</td>
      <td><?php echo $product_array[$key]['comname']; ?></td>
    </tr>
    <tr>
      <td>Feeding</td>
      <td><?php echo $product_array[$key]['feed']; ?></td>
    </tr>
    <tr>
      <td>Age</td>
      <td><?php echo $product_array[$key]['age']; ?></td>
    </tr>
    <tr>
      <td>Vendor</td>
      <td><?php echo $omgfinalshit; ?> <a href="vendorprofile.php?vendor=<?php echo $omgfinalshit; ?>">View Vendors Profile</a></td>
    </tr>
    <tr>
      <td>Price</td>
      <td><?php echo "$".number_format($product_array[$key]["price"]); ?></td>
    </tr>
    <tr>
      <td>Posted Date</td>
      <td><?php echo $product_array[$key]['posteddate']; ?></td>
    </tr>
  </tbody>
</table>

        <?php
				if ($omgfinalshit == $user_username) {
			?>
			
			<div><a href="editproduct.php?item=<?php echo htmlspecialchars($_GET["item"]); ?>">Edit Item</a></div>
			<?php 
				} else {
			?>
			<div><a href="messagevendor.php?item=<?php echo htmlspecialchars($_GET["item"]); ?>&vendor=<?php echo $product_array[$key]["vendorID"];?>">Message Vendor</a></div>
			<?php 
			    $prodid = $product_array[$key]['code'];;
			    $fuck = "SELECT user_id FROM wishlist WHERE product_id='$prodid'";
			    $fucker = mysqli_query($db_handle->conn, $fuck);
			    $fuckprod = mysqli_fetch_assoc($fucker);
		        $omgfinalfuck = implode("",$fuckprod);
		        
		        if ($omgfinalfuck == $userid) {
			?>
			    <div><a href="components/wish.php?item=<?php echo htmlspecialchars($_GET["item"]);?>&func=add">Add to Wishlist</a></div>
			<?php 
		        }
		            
		        }
			?>
			
	</form>
</div>
	<?php
			}
	}
?>
<?php include("footer.php"); ?>
</BODY>

<style type="text/css">
	.product-image img {
		height: 200px !important;
		width: auto;
	}
</style>
</HTML>