<!DOCTYPE html>
<html lang="en-US">

<head>
<meta charset="UTF-8">

<link rel="shortcut icon" href="https://invertarium.net/dev/images/favicon.ico" sizes="16x16" type="image/x-icon">

<link rel="stylesheet" href="https://invertarium.net/marshall/style/style.css">

<link href="https://fonts.googleapis.com/css?family=Comfortaa" rel="stylesheet">
<link href="https://fonts.googleapis.com/css?family=Cabin+Condensed|Righteous" rel="stylesheet">

<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

<?php 
include 'components/notify.php';
?>

<title>Invertarium</title>
</head>

<body>
	<div class="wrapper-outer"><div class="wrapper-inner">
		<div id="logo">
			<a href="https://invertarium.net/dev/"><img src="https://invertarium.net/dev/images/invertarium_logo3.png" class="logo-img"></a>
		</div>
		
		<div class="navbar">
							<ul>
					<li class="nav">
					<a href="/marshall/home.php" class="dropbtn">Home</a>
					</li>
				    <li class="nav">
					<a href="javascript:void(0)" class="dropbtn">Market</a>
					<div class="nav-content">
					  <a href="items.php?category=tarantulas">Tarantulas</a>
					  <a href="items.php?category=scorpions">Scorpions</a>
					  <a href="items.php?category=truespiders">True Spiders</a>
					  <a href="items.php?category=mantids">Mantids</a>
					  <a href="items.php?category=myriapoda">Myriapoda</a>
					  <a href="items.php?category=ants">Ants</a>
					  <a href="items.php?category=feeders">Feeders</a>
					  <a href="items.php?category=otherinverts">Other Inverts</a>
					  <a href="items.php?category=supplies">Supplies</a>
					</div>
				  </li>
				    <li class="nav">
					<a href="javascript:void(0)" class="dropbtn">Vendors</a>
					<div class="nav-content">
					    
					    <?php 
					   if($row['isVendor'] == "0") {
					    ?>
					  <a href="vendorsettings.php">Become a Vendor</a>
					  <?php } ?>
					  
					  <?php 
					  if($row['isVendor'] == "1") {
					  ?>
					  <a href="additem.php">Add Inventory</a>
					  <a href="view-listings.php">Edit Shop</a>
					  <?php } ?>
					  <a href="#">Get Premium!</a>
					</div>
				  </li>
				  <li class="nav">
					<a href="javascript:void(0)" class="dropbtn">How-To</a>
					<div class="nav-content">
					  <a href="#">Tour Invertarium</a>
					  <a href="#">Buying Guide</a>
					  <a href="#">Dispute a Sale</a>
					  <a href="#">Extra Resources</a>
					</div>
				  </li>
				  <li class="nav">
					<a href="javascript:void(0)" class="dropbtn">Contact</a>
					<div class="nav-content">
					  <a href="#">E-mail Staff</a>
					  <a href="#">About</a>
					  <a href="#">Terms of Service</a>
					  <a href="#">Privacy Policy</a>
					</div>
				  </li>
				  
				  <li class="nav">
					<a href="notifications.php" class="dropbtn">Notifications <?php echo $num_rows; ?></a>
				  </li>
				  
				  <?php
					
				  
					if($row['isAdmin'] == "1") {
						?>
						<li class="nav">
							<a href="javascript:void(0)" class="dropbtn adminn">Admin</a>
							<div class="nav-content">
							  <a href="adminpage.php">Modify Main Message</a>
							  <a href="changecategory.php">Change Category</a>
							  <a href="pendingvendors.php">Accept Vendors</a>
							  <a href="all-listings.php">All Listings</a>
							  <a href="all-users.php">User List</a>
							</div>
						</li>
						<?php
						
					}

				  ?>
				  
				</ul>
		</div>
		<style type="text/css">
		a.adminn {
			background-color: #e74c3c;
			border-bottom: 5px solid #c0392b;
		}
		</style>
	<table>
	<tr><td valign="top">
	
			<div class="sidebar center">
				<form class="search" action="search-result.php?q=<?php echo $_POST['q']; ?>" style="margin:auto;max-width:300px">
				  <input type="text" placeholder="Search.." name="q">
				  <button type="submit"><i class="fa fa-search"></i></button>
				</form>
						Welcome back, <button class="accordion"><b><?php echo ucfirst($user_username); ?></b>  <i class="arrow right-arrow"></i> .<br /></button>
							<div class="panel">
								<div class="sidenav">	 
								<a href="/marshall/my-messages.php" class="sidenav">Messages</a>
								<a href="wishlist.php" class="sidenav">Wish List</a>
								<a href="vendorprofile.php?vendor=<?php echo $user_username; ?>" class="sidenav">Vendor Menu</a>								
								<a href="profile.php?user_name=<?php echo $user_username; ?>&current_user=<?php echo $user_username; ?>" class="sidenav">User Profile</a>
								<a href="" class="sidenav">Premium</a>
								</div>
							</div><br />
							
							<a href="edit-profile.php" class="sidenav">Settings</a><br />
							<a href="components/logout.php" class="sidenav">Log out</a> <br />
							
						
								<script>
								var acc = document.getElementsByClassName("accordion");
								var i;

								for (i = 0; i < acc.length; i++) {
									acc[i].addEventListener("click", function() {
										this.classList.toggle("active");
										var panel = this.nextElementSibling;
										if (panel.style.display === "block") {
											panel.style.display = "none";
										} else {
											panel.style.display = "block";
										}
									});
								}
								</script>

					<br />
					
					<a href="https://www.facebook.com/groups/1806537862739077/" class="sidenavicons"><img width="35" src="https://invertarium.net/dev/images/fb-social.png"></a>
					<a href="https://discord.gg/RnNfD2A" class="sidenavicons"><img width="35" src="https://invertarium.net/dev/images/discord-social.png"></a>
					
			</div>
	</td><td valign="top">
		<div class="container 90-width justify">
		    
		    
		    
		    
<script type="text/javascript" id="cookieinfo" src="//cookieinfoscript.com/js/cookieinfo.min.js"></script>
