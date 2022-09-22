<?php 
include 'components/authentication.php'; 
include 'components/session-check.php'; 
include("header.php");
require_once("dbcontroller.php");
$db_handle = new DBController();

    if(isset($_GET['q'])){
        $q = $_GET['q'];
        $code = "SELECT user_id FROM user WHERE user_username='$q'";
		$runshit = mysqli_query($db_handle->conn, $code);
		$finalprod = mysqli_fetch_assoc($runshit);
		$omgfinalshit = implode("",$finalprod);
        $sql = mysqli_query($db_handle->conn, "SELECT * FROM tblproduct WHERE species LIKE '%$q%' OR sciname LIKE '%$q%' OR comname LIKE '%$q%' OR vendorID LIKE '%$omgfinalshit%' ORDER BY id");
        $number=mysqli_num_rows($sql);
    }
?>
                                
<?php 
    if($number > 1){ 
?>
        <h3 class="h3-style"><?php echo $number; ?> Results for "<?php echo $q; ?>"</h3>
<?php     
    }
    else{
?>
         <h3 class="h3-style"><?php echo $number; ?> Result for "<?php echo $q; ?>"</h3>                                 
<?php     
    }
?>
<?php
    if(isset($_GET['q'])){
        $q = $_GET['q'];
        
        $code = "SELECT user_id FROM user WHERE user_username='$q'";
		$runshit = mysqli_query($db_handle->conn, $code);
		$finalprod = mysqli_fetch_assoc($runshit);
		$omgfinalshit = implode("",$finalprod);
        
        $sql = mysqli_query($db_handle->conn, "SELECT * FROM tblproduct WHERE species LIKE '%$q%' OR sciname LIKE '%$q%' OR comname LIKE '%$q%' OR vendorID LIKE '%$omgfinalshit%' ORDER BY id");
    if( mysqli_num_rows($sql) > 0) {
            while($rws = mysqli_fetch_array($sql)){
?>
                <a href="product.php?item=<?php echo $rws["code"]; ?>&vendor=<?php echo $rws["vendorID"]; ?>">
            		<div class="results" style="background:url('userfiles/product-images/<?php echo $rws["image"]; ?>'); background-size: 100% 100%; width:200px; height:180px;">
            			<table class="resultstext">
            				<tr>
            					<td colspan="3" class="center"><b><?php echo $rws["sciname"]; ?></b></td>
            				</tr>
            				<tr>
            					<td class="left">Gender: <?php echo $rws["gender"]; ?></td>
            					<td class="center">Size: <?php echo $rws["size"]; ?></td>
            					<td class="right"><i>Price: $<?php echo $rws["price"]; ?></i></td>
            				</tr>
            			</table>
            		</div>
        		</a> 

<?php 
            } 
    } else{
?>

                                                                                    <h1>No Results to show</h1>

<?php      
        }
    }                                                              
?>                                                                
                                        