<?php include 'components/authentication.php';
include 'components/session-check.php';
include("header.php");
include 'controllers/navigation/first-navigation.php';
require_once("dbcontroller.php");
$db_handle = new DBController();
    session_start();
    
    $sql = "SELECT * FROM user WHERE user_username='$user_username'";
    $result = mysqli_query($db_handle->conn,$sql) or die(mysqli_error($db_handle->conn)); 
    $rws = mysqli_fetch_array($result);   
    
    
    $current_user = $_SESSION['user_username'];
    $user_username = mysqli_real_escape_string($db_handle->conn,$_REQUEST['user_username']);
    $profile_username=$rws['user_username'];
?>
<?php
    $url = 'http://'.$_SERVER['HTTP_HOST'].$_SERVER['PHP_SELF'];
?>
<div class="profile">

                <center>
                    <img style="height:200px; width: 200px;" src="userfiles/avatars/<?php echo $rws['user_avatar'];?>" class="img-responsive profile-avatar">
                    <br>
                </center>
                <h1 class="text-center profile-text profile-name"><?php echo $rws['user_firstname'];?> <?php echo $rws['user_lastname'];?></h1>
                <h2 class="text-center profile-text profile-profession"><?php echo $rws['user_profession'];?></h2>
                <br>

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
        
        
$country_names = json_decode(file_get_contents("http://country.io/names.json"), true);

function get_name($cc) {
    return $country_names[$cc];
}

$codetocountry = get_name($rws['user_country']);
?>   
 
                                        <p class="profile-details"><i class="fa fa-info"></i> Country</p>

                                        <p><?php echo $codetocountry; ?></p>

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
    if ($rws['user_maritialstatus']){
?>   

                                        <p class="profile-details"><i class="fa fa-users"></i> Maritial Status</p>

                                        <p><?php echo $rws['user_maritialstatus'];?></p>

<?php } ?>
<?php
    if ($rws['user_dob']){
?>   

                                        <p class="profile-details"><i class="fa fa-calendar"></i> Date of Birth</p>

                                        <p><?php echo $rws['user_dob'];?></p>

<?php } ?>

</div>