<?php
class DBController {
	private $host = "localhost";
	private $user = "invertar_marshal";
	private $password = "SkateVeteran";
	private $database = "invertar_shop";
	public $conn;
	
	function __construct() {
		$this->conn = $this->connectDB();
	}
	
	function connectDB() {
		$conn = mysqli_connect($this->host,$this->user,$this->password,$this->database);
		if (!$conn) {
            die("Connection failed: " . mysqli_connect_error());
        }
		return $conn;
	}
	
	function runQuery($query) {
		$result = mysqli_query($this->conn,$query);
		
		while($row=mysqli_fetch_assoc($result)) {
			$resultset[] = $row;
		} 
		if(!empty($resultset)) {
			return $resultset;
		}
		
	}		
	
	function numRows($query) {
		$result  = mysqli_query($this->conn,$query);
		$rowcount = mysqli_num_rows($result);
		return $rowcount;	
	}
}

?>