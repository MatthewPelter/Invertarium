<?php
    session_start();
    header( "refresh:1;url=../login.php" ); 
    echo "<center><h2>Wrong Username or Password... Redirecting shortly!</h2></center>";
?>