<form action="components/update-profile-after-registration.php" method="post" enctype="multipart/form-data" id="UploadForm" autocomplete="off">
<?php
    $user_username = mysqli_real_escape_string($db_handle->conn,$_REQUEST['user_username']);
    $sql = "SELECT * FROM user WHERE user_username='$user_username'";
    $result = mysqli_query($db_handle->conn,$sql);
    $rws = mysqli_fetch_array($result);
?>
<label for="">First Name</label>
<input type="text" class="form-control" placeholder="<?php echo $rws['user_firstname'];?>" name="user_firstname" value="<?php echo $rws['user_firstname'];?>" required>
<label for="">Last Name</label>
<input type="text" class="form-control"  placeholder="<?php echo $rws['user_lastname'];?>" name="user_lastname" value="<?php echo $rws['user_lastname'];?>" required>
<label for="">Avatar</label>
<center><input name="ImageFile"  class="btn btn-primary ladda-button" data-style="zoom-in"  type="file"/></center>
   

<label for="">Username</label>

<a href="<?php echo $rws['user_username'];?>">        
<fieldset disabled> 
<input type="text" class="form-control" placeholder="<?php echo $rws['user_username'];?>" name="user_username" value="<?php echo $rws['user_username'];?>" id="disabledTextInput" autocomplete="off" required>
</fieldset>
</a>


<label for="">Password</label>
<input type="password" class="form-control" placeholder="<?php echo $rws['user_password'];?>" name="user_password" value="<?php echo $rws['user_password'];?>" required>

<label for="">Email</label>
<input type="text" class="form-control" placeholder="<?php echo $rws['user_email'];?>" name="user_email" value="<?php echo $rws['user_email'];?>" required>
         
<?php
    $user_username =  $rws['user_username'];
?>     
    <hr>                 
    <div class="submit">           
        <center>
            <button class="btn btn-primary ladda-button" data-style="zoom-in" type="submit"  id="SubmitButton" value="Upload" />Save Your Profile</button>
        </center>
    </div>
</form>