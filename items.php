<?php
include 'components/authentication.php';
include 'components/session-check.php';
//include 'controllers/base/head.php';
include("header.php");
require_once("dbcontroller.php");
$db_handle = new DBController();
?>

<HTML>
<HEAD>

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" >

     
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
</HEAD>
<BODY>

<?php 
$categorby = securityscan($_GET['category']);
$sort = securityscan($_GET['sort']);
?>

<div id="product-grid">
	<div class="h1-style center">Products</div>
	
	<div class="h3-style">Sort by:</div>
	
    <select id="sort" name="sort" value="<?php echo $sort; ?>" data-foo="<?php echo $categorby; ?>">
      <option value=""></option>
      <option value="phtl">Price Highest to Lowest</option>
      <option value="plth">Price Lowest to highest</option>
      <option value="ayto">Age youngest to oldest</option>
      <option value="aoty">Age oldest to youngest</option>
      <option value="m">Males</option>
      <option value="f">Females</option>
      <option value="az">Alphabetic A-Z</option>
      <option value="za">Alphabetic Z-A</option>
      <option value="otn">Oldest to Newest listings</option>
      <option value="nto">Newest to Oldest listings</option>
    </select>



<?php 
function securityscan($data) {
	  $data = trim($data);
	  $data = stripslashes($data);
	  $data = htmlspecialchars($data);
	  return $data;
	}

	$age = securityscan($_GET['age']);
	$size = securityscan($_GET['size']);
	$species = securityscan($_GET['species']);
	$price = securityscan($_GET['price']);
	$gender = securityscan($_GET['gender']);
	
	$sql = "SELECT * FROM tblproduct WHERE category = '".$categorby."'";
	
	if (!empty($sort)) {
	    if ($sort == "phtl") {
	        $sql.=" ORDER BY price DESC";
	    } else if ($sort == "plth") {
	        $sql.=" ORDER BY price ASC";
	    } else if ($sort == "ayto") {
	        $sql.=" ORDER BY price ASC";
	    } else if ($sort == "aoty") {
	        $sql.=" ORDER BY price DESC";
	    } else if ($sort == "m") {
	        $sql.=" AND gender = 'male'";
	    } else if ($sort == "f") {
	        $sql.=" AND gender = 'female'";
	    } else if ($sort == "az") {
	        $sql.=" ORDER BY sciname ASC";
	    } else if ($sort == "za") {
	        $sql.=" ORDER BY sciname DESC";
	    } else if ($sort == "otn") {
	        $sql.=" ORDER BY posteddate ASC";
	    } else if ($sort == "nto") {
	        $sql.=" ORDER BY posteddate DESC";
	    } else {
	        echo "<br />Invalid Sort Option.";
	        $sql.=" ORDER BY id ASC";
	    }
	    
	} else {
	    $sql.=" ORDER BY id ASC";
	}

    
    $perpage = 4;
    if(isset($_GET['page']) & !empty($_GET['page'])){
    	$curpage = $_GET['page'];
    }else{
    	$curpage = 1;
    }
    $start = ($curpage * $perpage) - $perpage;
    $PageSql = $sql;
    $pageres = mysqli_query($db_handle->conn, $PageSql);
    $totalres = mysqli_num_rows($pageres);
    
    $endpage = ceil($totalres/$perpage);
    $startpage = 1;
    $nextpage = $curpage + 1;
    $previouspage = $curpage - 1;
    
    $ReadSql = $sql . " LIMIT $start, $perpage";
    //$res = mysqli_query($db_handle->conn, $ReadSql);



	$product_array = $db_handle->runQuery($ReadSql);
	$num_rows = $db_handle->numRows($sql);
	
	?>
		<div class="h3-style center"><?php echo $num_rows . " Product(s) Listed."; ?></div>
	<?php
	if (!empty($product_array)) { 
		foreach($product_array as $key=>$value){
	?>
		<a href="product.php?item=<?php echo $product_array[$key]["code"]; ?>&vendor=<?php echo $product_array[$key]["vendorID"]; ?>">
		<div class="results" style="background:url('userfiles/product-images/<?php echo $product_array[$key]["image"]; ?>'); background-size: 100% 100%; width:200px; height:180px;">
			<table class="resultstext">
				<tr>
					<td colspan="3" class="center"><b><?php echo $product_array[$key]["sciname"]; ?></b></td>
				</tr>
				<tr>
					<td class="left">Gender: <?php echo $product_array[$key]["gender"]; ?></td>
					<td class="center">Size: <?php echo $product_array[$key]["size"]; ?></td>
					<td class="right"><i>Price: $<?php echo $product_array[$key]["price"]; ?></i></td>
				</tr>
			</table>
		</div>
		</a>
	<?php
			}
			
	} else {
		echo "Sorry nothing is listed in this category";
	}

	?>
</div>

<br />

 <nav aria-label="Page navigation">
  <ul class="pagination pagination-lg">
  <?php if($curpage != $startpage){ ?>
    <li class="page-item">
      <a class="page-link" href="?category=<?php echo $categorby; ?>&page=<?php echo $startpage ?>" tabindex="-1" aria-label="Previous">
        <span aria-hidden="true">&laquo;</span>
        <span class="sr-only">First</span>
      </a>
    </li>
    <?php } ?>
    <?php if($curpage >= 2){ ?>
    <li class="page-item"><a class="page-link" href="?category=<?php echo $categorby; ?>&page=<?php echo $previouspage ?>"><?php echo $previouspage ?></a></li>
    <?php } ?>
    <li class="page-item active"><a class="page-link" href="?category=<?php echo $categorby; ?>&page=<?php echo $curpage ?>"><?php echo $curpage ?></a></li>
    <?php if($curpage != $endpage){ ?>
    <li class="page-item"><a class="page-link" href="?category=<?php echo $categorby; ?>&page=<?php echo $nextpage ?>"><?php echo $nextpage ?></a></li>
    <li class="page-item">
      <a class="page-link" href="?category=<?php echo $categorby; ?>&page=<?php echo $endpage ?>" aria-label="Next">
        <span aria-hidden="true">&raquo;</span>
        <span class="sr-only">Last</span>
      </a>
    </li>
    <?php } ?>
  </ul>
</nav>


<script>
$(function() { //run on document.ready
  $("#sort").change(function() { //this occurs when select 1 changes
    var temp = $("#sort").val();
    var extra = $("#sort").data('foo'); 
    var url = "https://invertarium.net/marshall/items.php?category=" + extra + "&sort=" + temp;
    
    
    window.location = url;
  });
});
</script>

</BODY>
</HTML>