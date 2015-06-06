<?php
	include 'login.php';
	error_reporting(E_ALL);
	ini_set('display_error','On');
?>
<?php
//	Get data from the current inventory
	function getData($mysqli, $inEmail, &$return_code){
	//	echo "In getData() - email is:'".$inEmail."'";
		// create a prepare statement 
		$stmt = $mysqli->prepare("SELECT cid FROM customer_reference WHERE cust_email=?;");

		// bind parameters as string
		$stmt->bind_param("s",$inEmail);
		
		// execute the statement
		$stmt->execute();
		
		// get result
		$result = $stmt->get_result();
	//	echo "After executing statement";

		if(($result->num_rows)==0) {
	//		echo $inEmail." does not exist in the table.";
			$return_code = 0;
		} else {
	//		echo $inEmail." exists in the table.";
			$return_code = 1;
		}
		// close statement
		$stmt->close();
	}
/*
	Main logic of the program
*/
	$return_code = 99;	//initialize return code
	define("SUCCESS", 0);

	$inEmail;
	if(isset($_POST['email'])) {
		$inEmail = $_POST['email'];
		if($inEmail != "") {	
			$return_code = 0;			// everything is good
	//		echo "Got input email!";
		} else {
			$return_code = 99;			// invalid email
	//		echo "Invalid email";
		}
	} else {
		$return_code = 99;				// missing input
	//	echo "Missing email";
	}
	
	if($return_code === SUCCESS) {
// 	Connecting to the database.
		$mysqli = new mysqli($dbhost, $dbuser, $dbpass, $dbname);
	
		if (mysqli_connect_error()) {
		    die('Connect Error (' . mysqli_connect_errno() . ') '
		            . mysqli_connect_error());
			$return_code = 99;			// set rc to fail
		} else {
	//		echo "Connecting to the database";
			getData($mysqli, $inEmail, $return_code);
		}
//	close connection
		$mysqli->close();
	}
	echo $return_code;	//test for not found
?>