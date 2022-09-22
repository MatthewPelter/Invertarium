<?php 
session_start();
include 'components/authentication.php';    
include 'components/session-check.php';
include("header.php");  

$sql = "SELECT maintext FROM websitesettings";
$result = mysqli_query($db_handle->conn, $sql);
$test = mysqli_fetch_assoc($result);
$maintext = implode("",$test);
?>
    <script>
        $.growl("<?php echo $dialogue; ?> ", {
            animate: {
                enter: 'animated zoomInDown',
                exit: 'animated zoomOutUp'
            }								
        });
    </script>
<div class="container">
    <div class="row clearfix">
        <div class="col-md-12">
		<h1 class="h1-style center">
				Invertebrates at your fingertips!
			</h1>
			<div class="maintext"><h3 class="h3-style">Announcement:</h3> <?php echo $maintext; ?></div>
		
            <h3 class="h3-style center">
				Buy, sell, and trade invertebrates worldwide.<br>
			</h3>
        </div>
        <div class="col-md-4"></div>
        <div class="col-md-4"></div>
		<div class="categories">
			<a href="items.php?category=tarantulas"><div class="invertcat cat-t"><span class="cattext">Tarantulas</span></div></a>
			<a href="items.php?category=scorpions"><div class="invertcat cat-scorp"><span class="cattext">Scorpions</span></div></a>
			<a href="items.php?category=truespiders"><div class="invertcat cat-spider"><span class="cattext">True Spiders</span></div></a>
			<a href="items.php?category=mantids"><div class="invertcat cat-mantis"><span class="cattext">Mantids</span></div></a>
			<a href="items.php?category=myriapoda"><div class="invertcat cat-pede"><span class="cattext">Myriapoda</span></div></a>
			<a href="items.php?category=ants"><div class="invertcat cat-ant"><span class="cattext">Ants</span></div></a>
			<a href="items.php?category=feeders"><div class="invertcat cat-feed"><span class="cattext">Feeders</span></div></a>
			<a href="items.php?category=otherinverts"><div class="invertcat cat-other"><span class="cattext">Other Inverts</span></div></a>
			<a href="items.php?category=supplies"><div class="invertcat cat-supply"><span class="cattext">Supplies</span></div></a>
			</br>
		</div>
    </div>
</div>

<?php include("footer.php"); ?>
<style type="text/css">
.maintext {
	text-align: center;
	font-size: 20px;
}
</style>