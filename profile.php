<?php 
include 'components/authentication.php';
include 'components/session-check-profile.php';
include 'controllers/base/style.php';
include("header.php");
require_once("dbcontroller.php");
$db_handle = new DBController();

    $current_user = $_SESSION['user_username'];
    $user_name = mysqli_real_escape_string($db_handle->conn,$_REQUEST['user_name']);
    $profile_username = $rws['user_username'];
    
    
    if (isset($_GET['request']) == "profile-update" && isset($_GET['status']) == "success") {
        echo "<h1 class='h1-style'>Profile Updated!</h1>";
    }
?>
<?php
    $url = 'http://'.$_SERVER['HTTP_HOST'].$_SERVER['PHP_SELF'];
?>


<style type="text/css">
    .profil {
        max-width: 1060px;
        width: 500px;
        text-align: center;
        background-color: #eee;
        padding: 20px;
    }

</style>



<div class="profil">
    <div class="profinner">
                    <img style="height:300px; width:300px; border-radius:100%; border:2px solid #333;" src="userfiles/avatars/<?php echo $rws['user_avatar'];?>" class="img-responsive profile-avatar">
                <h1><u><?php echo $rws['user_username'];?></u></h1>

                                    <p class="text-center profile-title"><i class="fa fa-info"></i> Basic</p>
                                    <hr>
<?php
    if ($rws['user_shortbio']){
?>   

                                        <p class="profile-details"><i class="fa fa-info"></i> Bio</p>


                                        <p><?php echo $rws['user_shortbio'];?></p>

<?php } ?>
<?php
    if ($rws['user_address']){
?>   

                                        <p class="profile-details"><i class="fa fa-info"></i> Location</p>

                                        <p><?php echo $rws['user_address'];?></p>

<?php } ?>
<?php
    if ($rws['user_email']){
?>   

                                        <p class="profile-details"><i class="fa fa-envelope"></i> Email</p>
                                   
                                        <p><?php echo $rws['user_email'];?></p>

<?php } ?>
<?php
    if ($rws['user_country']){
?>   

                                        <p class="profile-details"><i class="fa fa-info"></i> Country</p>

                                        <p><?php echo $rws['user_country'];?></p>

<?php } ?>

                                    <p class="text-center profile-title"><i class="fa fa-info"></i> Personal</p>
                                    <hr>
<?php
    if ($rws['user_gender']){
?>   

                                        <p class="profile-details"><i class="fa fa-user"></i> Gender</p>

                                        <p><?php echo $rws['user_gender'];?></p>

<?php } ?>
<?php
    if ($rws['user_dob']){
?>   

                                        <p class="profile-details"><i class="fa fa-calendar"></i> Date of Birth</p>

                                        <p><?php echo $rws['user_dob'];?></p>

<?php } ?>

<?php 
    if ($rws['isVendor'] == "1") {
?>
                                        <a href="vendorprofile.php?vendor=<?php echo $rws['user_username']; ?>">View Vendors Profile</a>
                                        <a href="viewvendorlist.php?vendor=<?php echo $rws['user_id']; ?>">View Vendors Listings</a>
                                        
<?php 
}
?>
                                        
</div>
</div>
<?php include("footer.php"); ?>