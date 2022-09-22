<?php 
include 'components/authentication.php';    
include 'components/session-check.php'; 
include("header.php");
include('classes/Mail.php');
require_once("dbcontroller.php");
$db_handle = new DBController();

function securityscan($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}

if (!empty($_GET['accept'])) {
    $acceptid = securityscan($_GET['accept']);
    
    $sql2 = "UPDATE user SET isVendor='1' WHERE user_id='$acceptid'";
    $result2 = mysqli_query($db_handle->conn,$sql2) or die(mysqli_error($db_handle->conn));
    
    $sql4 = "DELETE FROM pendingvendor WHERE userid='$acceptid'";
    $result4 = mysqli_query($db_handle->conn,$sql4) or die(mysqli_error($db_handle->conn));

    $username = mysqli_query($db_handle->conn, "SELECT user_firstname, user_lastname FROM user WHERE user_id='$acceptid'") or die(mysqli_error($db_handle->conn));
    $finalprod = mysqli_fetch_assoc($username);
	$omgfinalshit = implode(" ",$finalprod);

    $add = "INSERT INTO vendors (user_id, name, datejoined) VALUES ('$acceptid', '$omgfinalshit', CURRENT_TIMESTAMP)";
    $addres = mysqli_query($db_handle->conn,$add) or die(mysqli_error($db_handle->conn));


    if ($result2 && $result4 && $addres) {
        echo "Success";
        
        $em = "SELECT user_email FROM user WHERE user_id='$acceptid'";
        $emresult = mysqli_query($db_handle->conn,$em) or die(mysqli_error($db_handle->conn));
        $finalem = mysqli_fetch_assoc($username);
	    $omgfinalem = implode("",$finalem);
        
        Mail::sendMail('You are now a Vendor', "You have been accepted as a vendor on Invertarium. Congrats!", $omgfinalem);
    } else {
        echo "Error: Contact Web Developer";
    }

} else if (!empty($_GET['deny'])) {
    $denyid = securityscan($_GET['deny']);
    
    $sql3 = "DELETE FROM pendingvendor WHERE userid='$denyid'";
    $result3 = mysqli_query($db_handle->conn,$sql3) or die(mysqli_error($db_handle->conn));

    if ($result3) {
        echo "Success";
    } else {
        echo "Error: Contact Web Developer";
    }
}



$sql2 = "SELECT * FROM user where user_username='$user_username'";
$result2 = mysqli_query($db_handle->conn,$sql2) or die(mysqli_error($db_handle->conn));
$row = mysqli_fetch_assoc($result2);

if ($row['isAdmin'] == "1") {
?>

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

<table class="GeneratedTable">
  <thead>
    <tr>
      <th>Username</th>
      <th>ID</th>
      <th>Message</th>
      <th>Decision</th>
    </tr>
  </thead>
  <tbody>
      <?php
        $sql = "SELECT * FROM pendingvendor order by userid desc";
        $result = mysqli_query($db_handle->conn,$sql) or die(mysqli_error($db_handle->conn));
	    $rws = mysqli_fetch_array($result);
        foreach ($result as $userr){ 
      
    ?>  
    <tr>
          <td><?php echo $userr['username']; ?></td>
          <td><?php echo $userr['userid']; ?></td>
          <td><?php echo $userr['message']; ?></td>
          <td><a href="pendingvendors.php?accept=<?php echo $userr['userid']; ?>">Accept</a>
          <a href="pendingvendors.php?deny=<?php echo $userr['userid']; ?>">Deny</a></td>
    </tr>
    
    
    <?php
        }
    ?>
    
  </tbody>
</table>


<?php
}
?>



<?php include("footer.php"); ?>