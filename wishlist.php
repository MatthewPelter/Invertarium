<?php
include 'components/authentication.php';
include 'components/session-check.php';
include("header.php");
require_once("dbcontroller.php");
$db_handle = new DBController();
?>

<HTML>
<BODY>
    
    
    
    
    
    
    
    <h1 class="h1-style">Wishlist</h1>
    
    <?php 
    
    
    function securityscan($data) {
      $data = trim($data);
      $data = stripslashes($data);
      $data = htmlspecialchars($data);
      $data = addslashes($data);
      return $data;
    }
    
    
    if (isset($_GET['status'])) {
        $staty = securityscan($_GET['status']);
        
        switch ($staty) {
            case success:
                echo "Wishlist has been updated!";
                break;
            case failed:
                echo "Wishlist failed to update...";
                break;
            default:
                
        }
        
        
    }
    
    
    $sql1 = "SELECT user_id FROM user WHERE user_username='$user_username'";
    $result1 = mysqli_query($db_handle->conn, $sql1) or die(mysqli_error($db_handle->conn));
    $finalprod = mysqli_fetch_assoc($result1);
	$omgfinalshit = implode("",$finalprod);
    
    $sql = "SELECT * FROM wishlist WHERE user_id='$omgfinalshit'";
    $result = mysqli_query($db_handle->conn, $sql) or die(mysqli_error($db_handle->conn));
?>
<table class="GeneratedTable"> 
<thead>
    <tr>
      <th>Species</th>
      <th>Common Name</th>
      <th>Science Name</th>
      <th>Item</th>
      <th>Remove</th>
    </tr>
  </thead>
  <tbody>
<?php

    foreach($result as $r) {
        $prod = $r['product_id'];
        $sql2 = "SELECT * FROM tblproduct WHERE code='$prod'";
        $res = mysqli_query($db_handle->conn, $sql2) or die(mysqli_error($db_handle->conn));
        $rws = mysqli_fetch_array($res);  
        
        ?>
            
                <tr>
                    <td><?php echo $rws['species']; ?></td>
                    <td><?php echo $rws['comname']; ?></td>
                    <td><?php echo $rws['sciname']; ?></td>
                    <td><a href="product.php?item=<?php echo $rws['code']; ?>&vendor=<?php echo $rws['vendorID']; ?>">Go To Item</a></td>
                    <td><a href="components/wish.php?item=<?php echo $r['product_id']; ?>&func=remove">Remove</a></td>
                </tr>
            

    <?php
    }
    ?>
    </tbody>
</table>
    
    
    <style>
        table.GeneratedTable {
          width: 100%;
          background-color: #ffffff;
          border-collapse: collapse;
          border-width: 2px;
          border-color: #408080;
          border-style: solid;
          color: #000000;
        }
        
        table.GeneratedTable td, table.GeneratedTable th {
          border-width: 2px;
          border-color: #408080;
          border-style: solid;
          padding: 15px;
        }
        
        table.GeneratedTable thead {
          background-color: #408080;
        }
</style>
    
    
    
    
    
    
    
    
</BODY>
<?php include("footer.php"); ?>
</HTML>