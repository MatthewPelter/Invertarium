<?php
include 'components/authentication.php';
include 'components/session-check.php';
include("header.php");
?>

<HTML>
<BODY>
    
    <h1 class="h1-style">Notifications</h1>
  <table class="GeneratedTable">  
    <?php 
        foreach($notres as $n) {
            
            if ($n['type'] == "1") {
                $yeet = $n['sender'];
                $sqlyeet = "SELECT user_username FROM user WHERE user_id='$yeet'";
                $resultyeet = mysqli_query($db_handle->conn,$sqlyeet) or die(mysqli_error($db_handle->conn));
                $rowyeet = mysqli_fetch_assoc($resultyeet);
        ?>
                          
                                
                  <tbody>
                    <tr>
                      <td><?php echo $rowyeet['user_username']; ?></td>
                      <td><?php echo $n['extra']; ?></td>
                      <td><a href="/marshall/my-messages.php?sender=<?php echo $n['sender']; ?>&read=true">View</a></td>
                    </tr>
                  </tbody>

        <?php 
            } else {
        ?>
                <tbody>
                    <b>
                    <tr>
                      <td><b><?php echo $n['sender']; ?></b></td>
                      <td><b><?php echo $n['extra']; ?></b></td>
                      <td><a href="/marshall/my-messages.php?sender=<?php echo $n['sender']; ?>&read=true">View</a></td>
                    </tr>
                    </b>
                </tbody>
          
          
        <?php        
            }
        
        }
    ?>
    </table>
    
    
    
    
    
    <style type="text/css">
        table.GeneratedTable {
          width: 100%;
          background-color: #ffffff;
          border-collapse: collapse;
          border-width: 2px;
          border-color: #000000;
          border-style: solid;
          color: #000000;
        }
        
        table.GeneratedTable td, table.GeneratedTable th {
          border-width: 2px;
          border-color: #000000;
          border-style: solid;
          padding: 3px;
        }
        
        table.GeneratedTable thead {
          background-color: #ffcc00;
        }
    </style>
    
    
    
    
    
    
    
    
    
    
</BODY>
<?php include("footer.php"); ?>
</HTML>