<?php 
require_once("dbcontroller.php");
$db_handle = new DBController();
?>

<HTML>
<HEAD>
<TITLE>Simple Shop by Q. Marshall</TITLE>
<link href="style.css" type="text/css" rel="stylesheet" />
</HEAD>
<BODY>

<h2>PHP Form Validation Example</h2>
<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">  
  Category: 
  <select name="cats">
	  <option value="tarantulas">Tarantulas</option>
	  <option value="scorpions">Scorpions</option>
	  <option value="truespiders">True Spiders</option>
	  <option value="mantids">Mantids</option>
	  <option value="myriapoda">Myriapoda</option>
	  <option value="ants">Ants</option>
	  <option value="feeders">Feeders</option>
	  <option value="other">Other Inverts</option>
	  <option value="supplies">Supplies</option>
  </select>
  <br><br>
  Species: <input type="text" name="spec">
  <br><br>
  Sex: 
  <input type="radio" name="gender" value="female" checked>Female
  <input type="radio" name="gender" value="male">Male
  <br><br>
  Age (Growth Stage): <input type="text" name="age">
  <br><br>
  # Available: <input type="text" name="amount">
  <br><br>
  Size (inches): <input type="text" name="size">
  <br><br>
  Birth Year: <input type="text" name="yob">
  <br><br>
  Scientific Name: <input type="text" name="sciname">
  <br><br>
  Common Name: <input type="text" name="comname">
  <br><br>
  Currently Feeding: <input type="text" name="feed">
  <br><br>
  Description: <textarea name="desc" rows="10" cols="70"></textarea>
  <br><br>
 <!-- Product Image: <input type="file" name="fileToUpload" id="fileToUpload">
  <br><br>-->
  Price: $<input type="text" name="price">
  <br><br>
  <input type="submit" name="submit" value="List">  
</form>


</BODY>
</HTML>