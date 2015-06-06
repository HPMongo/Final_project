<?php
	include 'login.php';
	error_reporting(E_ALL);
	ini_set('display_error','On');
?>
<?php
//	Get data from the current inventory
	function getData($mysqli, $inEmail){
		// create a prepare statement 
		$stmt = $mysqli->prepare("SELECT cid FROM customer_references WHERE email=?;");
		

		// execute the statement
		$stmt->execute();
		
		// bind result
		//$stmt->bind_result($sqlResult);
		$sqlResult = $stmt->get_result();

		// display the result
		displayData($sqlResult);

		// close statement
		$stmt->close();
	}

// 	Connecting to the database. If everything is good, call getData to
// 	display the current inventory
	$mysqli = new mysqli($dbhost, $dbuser, $dbpass, $dbname);
	
	if (mysqli_connect_error()) {
	    die('Connect Error (' . mysqli_connect_errno() . ') '
	            . mysqli_connect_error());
	} else {
		getData($mysqli);
	}
//	close connection
	$mysqli->close();
?>