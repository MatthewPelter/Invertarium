<?php
include 'components/authentication.php';    
include 'components/session-check.php';
include("header.php");  
require_once("dbcontroller.php");
$db_handle = new DBController();
?>


<h1 class="h1-style center">All Listings</h1>


<?php

function securityscan($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}

if (!empty($_GET['admindelitem'])) {
    $adminid = securityscan($_GET['admindelitem']);
    
    $adminsql = "DELETE FROM tblproduct WHERE code='$adminid'";
    $adminex = mysqli_query($db_handle->conn,$adminsql) or die(mysqli_error($db_handle->conn));
    
    if ($adminex) {
        echo "Success";
    } else {
        echo "Error: Contact Web Developer";
    }
}





	
	$product_array = $db_handle->runQuery("SELECT * FROM tblproduct ORDER BY id ASC");
	if (!empty($product_array)) { 
		foreach($product_array as $key=>$value){
	?>
		<div class="product-item">
			<form method="post" action="">
			<div class="product-image"><img src="userfiles/product-images/<?php echo $product_array[$key]["image"]; ?>"></div>
			<div><strong><?php echo $product_array[$key]["species"]; ?></strong></div>
			<div>Category: <?php echo $product_array[$key]["category"]; ?></strong></div>
			<div>Gender: <?php echo $product_array[$key]["gender"]; ?></div>
			<div>Description: <?php echo $product_array[$key]["descrip"]; ?></div>
			<div>Size: <?php echo $product_array[$key]["size"]; ?> inches</div>
			<div>Year of Birth: <?php echo $product_array[$key]["yob"]; ?></div>
			<div>Science Name: <?php echo $product_array[$key]["sciname"]; ?></div>
			<div>Common Name: <?php echo $product_array[$key]["comname"]; ?></div>
			<div>Feeding: <?php echo $product_array[$key]["feed"]; ?></div>
			<div>Age: <?php echo $product_array[$key]["age"]; ?></div>
			<div>Vendor: <?php echo $omgfinalshit; ?></div>
			<div class="product-price"><?php echo "$".number_format($product_array[$key]["price"]); ?></div>
			
			<a class="btnn" href="adminedit.php?adminedititem=<?php echo $product_array[$key]["code"]; ?>">Edit Item</a>
			<a class="btnn" href="all-listings.php?admindelitem=<?php echo $product_array[$key]["code"]; ?>">Delete Item</a>
			</form>
		</div>
	<?php
			}
	}
	
	?>



<style type="text/css">
    .product-image img {
        height: 300px;
        width: auto;
    }
</style>



<?php include("footer.php"); ?>