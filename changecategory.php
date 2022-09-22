<?php
include 'components/authentication.php';
include 'components/session-check.php';
include("header.php");
require_once("dbcontroller.php");
$db_handle = new DBController();
?>

<HTML>
<BODY>
    
    
    
    <div class="h1-style center">Change Category</div>
    
    <?php
    $catgetter = mysqli_query($db_handle->conn, "SELECT * FROM webcategories");
    
    function securityscan($data) {
      $data = trim($data);
      $data = stripslashes($data);
      $data = htmlspecialchars($data);
      return $data;
    }
    
    $yeet = securityscan($_GET['delcat']);
    
    if (!empty($yeet)) {
        
        $dell = securityscan($_GET['delcat']);
        $delcat = mysqli_query($db_handle->conn, "DELETE FROM webcategories WHERE category='$dell'");

        
        if ($delcat) {
            echo "Deleted";
            $_GET = array();
        } else {
            echo "broken";
        }
    }

    if (isset($_POST['submit'])) {
        
        $addd = securityscan($_POST['cate']);
        $addcat = mysqli_query($db_handle->conn, "INSERT INTO webcategories (category) VALUES ('".$addd."')");
        
        if ($addcat) {
            echo "Added !";
            $_POST = array();
        } else {
            echo "broken";
        }
        
    }
    
    foreach ($catgetter as $catt) {
        echo $catt['category'] . "<a href='changecategory.php?delcat=" . $catt['category'] . "'>" . "X" . "</a>" . "<br>";
        
    }
    
    ?>
    

    <form method="post" enctype="multipart/form-data" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">  
        <input type="text" name="cate">
        <input type="submit" name="submit" value="Add Category">  
    </form>


</BODY>
<?php include("footer.php"); ?>
</HTML>