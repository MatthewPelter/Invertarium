<?php 
include 'components/authentication.php';
include 'components/session-check.php';
include("header.php");
require_once("dbcontroller.php");
$db_handle = new DBController();

$current_user = $_SESSION['user_username'];
function securityscan($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}

function createRandomCode() { 
		$chars = "0123456789"; 
		srand((double)microtime()*1000000); 
		$i = 0; 
		$pass = '' ; 
		while ($i <= 5) { 
			$num = rand() % 10; 
			$tmp = substr($chars, $num, 1); 
			$pass = $pass . $tmp; 
			$i++; 
		} 
		return $pass; 
}

if (isset($_POST['send'])) {
		
		$code = "SELECT user_id FROM user WHERE user_username='$current_user'";
		$runshit = mysqli_query($db_handle->conn, $code);
		$finalprod = mysqli_fetch_assoc($runshit);
		$omgfinalshit = implode("",$finalprod);
		
		
		$body = securityscan($_POST['body']);
		$sender = securityscan($omgfinalshit);
		$receiver = securityscan($_GET['receiver']);
		$producto = securityscan($_GET['product']);
		$readstatus = 0;
		
		$sql = "SELECT user_id FROM user WHERE user_id='$receiver'";
		
        if (mysqli_query($db_handle->conn,$sql)) {
				$sql2 = "INSERT INTO messages (body, sender, receiver, isRead, product) VALUES ('".$body."','".$sender."','".$receiver."','".$readstatus."','".$producto."')";
				$sendmess = mysqli_query($db_handle->conn, $sql2) or die(mysqli_error($db_handle->conn));
				
				$sqql = "INSERT INTO notifications (type, receiver, sender, extra) VALUES ('0','".$receiver."','".$sender."','New Message!')";
				$sendnot = mysqli_query($db_handle->conn, $sqql) or die(mysqli_error($db_handle->conn));
			    
			    echo "Message Sent";
        } else {
				echo "Error: " . $sql . "<br>" . mysqli_error($db_handle->conn);
                die('Invalid ID!');
        }
}

?>