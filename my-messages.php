<?php
include 'components/authentication.php';
include 'components/session-check.php';
include("header.php");
require_once("dbcontroller.php");
$db_handle = new DBController();
?>

<HTML>
<HEAD>
    <link rel="stylesheet" href="https://invertarium.net/marshall/style/messagestyle.css">
</HEAD>
<BODY>

<div id="product-grid">
	<div class="h1-style">My Messages</div>
	
	
<?php
	function securityscan($data) {
	  $data = trim($data);
	  $data = stripslashes($data);
	  $data = htmlspecialchars($data);
	  return $data;
	}
	
	//This was a fucking pain in the ass to get working
	
	$code = "SELECT user_id FROM user WHERE user_username='$user_username'";
	$runshit = mysqli_query($db_handle->conn, $code);
	$finalprod = mysqli_fetch_assoc($runshit);
	$omgfinalshit = implode("",$finalprod);
	if (!empty($_GET)) {
	    
	    ?>
<div class="ui">
  <div class="left-menu">
      <br />
    <menu class="list-friends">


	    
	    <?php
	    
	    $senderr = securityscan($_GET['sender']);
	    if ($_GET['read'] == "true") {
	        $notsql = "UPDATE notifications SET type='1' WHERE sender='$senderr'";
            $notresult = mysqli_query($db_handle->conn,$notsql) or die(mysqli_error($db_handle->conn));
	    }
	    
	    

		
		$messages = mysqli_query($db_handle->conn, "SELECT messages.id, messages.body, messages.product, s.user_username AS Sender, r.user_username AS Receiver
		FROM messages
		LEFT JOIN user s ON messages.sender = s.user_id
		LEFT JOIN user r ON messages.receiver = r.user_id
		WHERE (r.user_id='$omgfinalshit' AND s.user_id='$senderr') OR r.user_id='$senderr' AND s.user_id='$omgfinalshit'");

		$users = mysqli_query($db_handle->conn, "SELECT s.user_username AS Sender, r.user_username AS Receiver, s.user_id AS SenderID, r.user_id AS ReceiverID FROM messages 
		LEFT JOIN user s ON s.user_id = messages.sender 
		LEFT JOIN user r ON r.user_id = messages.receiver 
		WHERE (s.user_id = '$omgfinalshit' OR r.user_id = '$omgfinalshit')");
		
		while($low = mysqli_fetch_assoc($users)) {
			$rest[] = $low; 
		}
		$u = array();
		foreach ($users as $user) {
			if (!in_array(array('username'=>$user['Receiver'], 'id'=>$user['ReceiverID']), $u)) {
				array_push($u, array('username'=>$user['Receiver'], 'id'=>$user['ReceiverID']));
			}
			if (!in_array(array('username'=>$user['Sender'], 'id'=>$user['SenderID']), $u)) {
				array_push($u, array('username'=>$user['Sender'], 'id'=>$user['SenderID']));
			}
		}
		//print_r($u);
		
		foreach ($u as $oof) {
			if ($oof['id'] != $omgfinalshit) {
				//echo "<div class='usersyeet'><p style='background-color:#eee;color:#000;padding:20px;'><b><a href='/marshall/my-messages.php?sender=".$oof['id']."'>".$oof['username']."</a></b></p></div>";
				$userrr = $oof['id'];
				$resssssy = mysqli_query($db_handle->conn, "SELECT * FROM user WHERE user_id='$userrr'");
			    $finalress = mysqli_fetch_assoc($resssssy);
			    
				//echo "<div class='usersyeet'><p style='background-color:#eee;color:#000;padding:20px;'><b><a href='/marshall/my-messages.php?sender=".$oof['id']."'>".$oof['username']."</a></b></p></div>";
				echo "<li><a href='?sender=".$oof['id']."'><img width='50' height='50' src='userfiles/avatars/".$finalress['user_avatar']."'><div class='info'><div class='user'>".$oof['username']."</div></div></a></li>";
			}		
		}
		
		while($row = mysqli_fetch_assoc($messages)) {
			$test[] = $row; 
		}



?>
</menu>
  </div>
  <div class="chat">
    <div class="top">
        
    </div>
        <ul class="messages">
<?php
		if (!empty($messages)) {
			foreach($test as $message) {
				$nameretreiver = $message['Sender'];
				$coder = $message['product'];
				
				$itemm = mysqli_query($db_handle->conn, "SELECT * FROM tblproduct WHERE code='$coder'");
			    $finalitem = mysqli_fetch_assoc($itemm);
				
				if ($message['Sender'] == $user_username) {
                    echo "<li class='i'><div class='head'><span class='time'>(".$finalitem['species'].", ".$finalitem['sciname'].", ".$finalitem['comname'].", <a href='product.php?item=".$coder."'>Item</a>) </span><span class='name'>".$message['Sender']."</span></div><div class='message'>".$message['body']."</div></li>";
				} else {
                    echo "<li class='friend-with-a-SVAGina'><div class='head'><span class='time'>(".$finalitem['species'].", ".$finalitem['sciname'].", ".$finalitem['comname'].", <a href='product.php?item=".$coder."'>Item</a>) </span><span class='name'>".$message['Sender']."</span></div><div class='message'>".$message['body']."</div></li>";
 
				}
			
				//echo "<div class='message-from-me message'><p style='color:#000;padding:10px;'><b>".$message['body']."</b> -".$message['Sender']."</p></div>";
			}
		} else {
			echo "Sorry you have no messages";
		}

		
		//print_r($test);
	
?>	


      
    </ul>
    <!--
    <div class="write-form">
      <textarea placeholder="Type your message" name="e" id="texxt" rows="2"></textarea>
      <span class="send">Send</span>
    </div>
    -->
    <form class="write-form" action="send-message.php?receiver=<?php echo $senderr; ?>&product=<?php echo $message['product']; ?>" method="post">
		<textarea placeholder="Type your message" name="body" id="texxt" rows="2"></textarea>
		<input class="send" type="submit" name="send" value="Send Message">
	</form>
  
</div>
</div>
<!--
	<form action="send-message.php?receiver=<?php echo $senderr; ?>&product=<?php echo $message['product']; ?>" method="post">
		<textarea name="body" rows="2" cols="70"></textarea><br>
		<input type="submit" name="send" value="Send Message">
	</form>-->
</div>

<?php 
} else {
    ?>
<div class="ui">
  <div class="left-menu">
      <br />
    <menu class="list-friends">
      


    <?php
    
	$users = mysqli_query($db_handle->conn, "SELECT s.user_username AS Sender, r.user_username AS Receiver, s.user_id AS SenderID, r.user_id AS ReceiverID FROM messages 
		LEFT JOIN user s ON s.user_id = messages.sender 
		LEFT JOIN user r ON r.user_id = messages.receiver 
		WHERE (s.user_id = '$omgfinalshit' OR r.user_id = '$omgfinalshit')");
		
		while($low = mysqli_fetch_assoc($users)) {
			$rest[] = $low; 
		}
		$u = array();
		foreach ($users as $user) {
			if (!in_array(array('username'=>$user['Receiver'], 'id'=>$user['ReceiverID']), $u)) {
				array_push($u, array('username'=>$user['Receiver'], 'id'=>$user['ReceiverID']));
			}
			if (!in_array(array('username'=>$user['Sender'], 'id'=>$user['SenderID']), $u)) {
				array_push($u, array('username'=>$user['Sender'], 'id'=>$user['SenderID']));
			}
		}
		//print_r($u);
		
		foreach ($u as $oof) {
			if ($oof['id'] != $omgfinalshit) {
			    
			    $userrr = $oof['id'];
			    
			    $resssssy = mysqli_query($db_handle->conn, "SELECT * FROM user WHERE user_id='$userrr'");
			    $finalress = mysqli_fetch_assoc($resssssy);
			    
				//echo "<div class='usersyeet'><p style='background-color:#eee;color:#000;padding:20px;'><b><a href='/marshall/my-messages.php?sender=".$oof['id']."'>".$oof['username']."</a></b></p></div>";
				echo "<li><a href='?sender=".$oof['id']."'><img width='50' height='50' src='userfiles/avatars/".$finalress['user_avatar']."'><div class='info'><div class='user'>".$oof['username']."</div></div></a></li>";
			}
		}
		
		?>
		    </menu>
  </div>
		<?php
	
}
?>

</BODY>
<?php include("footer.php"); ?>
</HTML>