<?php
include 'components/authentication.php';
include 'components/session-check.php';
include("header.php");
require_once("dbcontroller.php");
$db_handle = new DBController();
?>

<HTML>
<BODY>
    
    
    
    
    <h1 class="h1-style">Vendor Profile (WORK IN PROGRESS)</h1>
    
    
    <?php
        function securityscan($data) {
            $data = trim($data);
            $data = stripslashes($data);
            $data = htmlspecialchars($data);
            $data = addslashes($data);
            return $data;
        }
        
        
        if (isset($_GET['vendor']) && !empty($_GET['vendor'])) {
            $vendor = securityscan($_GET['vendor']);
            
            $sql = "SELECT * FROM vendors WHERE user_username='$vendor'";
            $result = mysqli_query($db_handle->conn,$sql) or die(mysqli_error($db_handle->conn));
            $row = mysqli_fetch_assoc($result);
            
            if ($db_handle->numRows($sql) == 0) {
                die('User is not a vendor!');
            }
            
            $vendorid = $row['user_id'];
            $pulldata = "SELECT * FROM tblproduct WHERE vendorID='$vendorid' LIMIT 4";
            
            $product_array = $db_handle->runQuery($pulldata);
            
        }
        
    
    ?>
    
    <div class="vendorname">Name: <?php echo $row['name']; ?> </div>
    <div class="location">Location <?php echo $row['location']; ?> </div>
    <div class="website">Website: <?php echo $row['website']; ?> </div>
    <div class="deliv">Delivery Options: <?php echo $row['delivoption']; ?> </div>
    <div class="datejoined">Date Joined: <?php echo $row['datejoined']; ?> </div>
    <div class="about">About: <?php echo $row['about']; ?> </div>
    <div class="terms">Terms: <?php echo $row['terms']; ?> </div>
    <div class="shipping">Shipping Policy: <?php echo $row['shippingpolicy']; ?> </div>
    <div class="products">
    	<?php
	if (!empty($product_array)) { 
		foreach($product_array as $key=>$value){
	?>
		<a href="product.php?item=<?php echo $product_array[$key]["code"]; ?>&vendor=<?php echo $product_array[$key]["vendorID"]; ?>">
		<div class="results" style="background:url('userfiles/product-images/<?php echo $product_array[$key]["image"]; ?>'); background-size: 100% 100%; width:200px; height:180px;">
			<table class="resultstext">
				<tr>
					<td colspan="3" class="center"><b><?php echo $product_array[$key]["sciname"]; ?></b></td>
				</tr>
				<tr>
					<td class="left">Gender: <?php echo $product_array[$key]["gender"]; ?></td>
					<td class="center">Size: <?php echo $product_array[$key]["size"]; ?></td>
					<td class="right"><i>Price: $<?php echo $product_array[$key]["price"]; ?></i></td>
				</tr>
			</table>
		</div>
		</a>
	<?php
			}
			
	} else {
		echo "Sorry nothing is listed in this category";
	}

	?>
    </div><br />
    <a href="viewvendorlist.php?vendor=<?php echo $vendorid; ?>">View Vendor Listings</a><br />
    
    
    <?php 
        if ($vendor == $user_username) {
    ?>
        <a href="vendoredit.php">Edit Vendor Profile</a>
    <?php 
        }
    ?>
    
    
    
</BODY>
<?php include("footer.php"); ?>
</HTML>