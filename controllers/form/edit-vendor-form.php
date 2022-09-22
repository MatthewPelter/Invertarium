<form action="components/edit-vendor.php" method="post" enctype="multipart/form-data" id="UploadForm">
                    
                    <label for="">Name</label>
                    <input type="text" class="form-control" placeholder="<?php echo $rws['name'];?>" name="name" value="<?php echo $rws['name'];?>">
                    <br>
                <label for="">Username</label>

                <fieldset disabled> 
                    <input type="text" placeholder="<?php echo $rws['user_username'];?>" name="user_username" value="<?php echo $rws['user_username'];?>" id="disabledTextInput" autocomplete="off">
                </fieldset>  

                    <label for="">About</label>
                    <br> 
                    <textarea class="form-control" placeholder="<?php echo $rws['about'];?>" cols="50" rows="10" placeholder="<?php echo $rws['about'];?>" name="about" value="<?php echo $rws['about'];?>"><?php echo $rws['about'];?></textarea>
                    <br> 
                    
                    <label for="">Location</label>   
                    <input type="text" class="form-control" placeholder="<?php echo $rws['location'];?>" name="location" value="<?php echo $rws['location'];?>">      
                    <br> 
                    <label for="">Terms</label>
                    <input type="text" class="form-control" placeholder="<?php echo $rws['terms'];?>" name="terms" value="<?php echo $rws['terms'];?>">    
                    <br> 
                    <label for="">Delivery Options</label>
                    <label><input type="radio" name="deliv" id="optionsRadios1" value="localpickup" checked>Local Pickup</label>

                    <label><input type="radio" name="deliv" id="optionsRadios1" value="shipping">Shipping</label>    
                    <br> 
                    <label for="">Shipping Policy</label>
                    <input type="text" class="form-control" placeholder="<?php echo $rws['shippingpolicy'];?>" name="shippingpolicy" value="<?php echo $rws['shippingpolicy'];?>">    
                    <br> 
                    
                    <label for="">Website</label>
                        http://
                        <input type="text" class="form-control" placeholder="<?php echo $rws['website'];?>" name="website" value="<?php echo $rws['website'];?>">                  
   
                    <br>
            <input type="submit" name="submit" value="Update Vendor Profile"> 
                        <br />
</form>