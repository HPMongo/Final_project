<?php
	include 'login.php';
	error_reporting(E_ALL);
	ini_set('display_error','On');
?>
<?php
	session_start();
/*
	This function will add information to the shipping
*/
function addShippingInfo($mysqli, $i_cid, $i_fName, $i_street, $i_city, $i_state, $i_zipCode, $i_phone, &$return_code) {
		//Add shipping information
		$stmt = $mysqli->prepare("INSERT into shipping_detail(cid, name, street, city, state, zip_code, phone)VALUES(?,?,?,?,?,?,?)");
		// bind parameters
		$stmt->bind_param("issssii",$i_cid, $i_fName, $i_street, $i_city, $i_state, $i_zipCode, $i_phone);
		// execute the statement
		if(!$stmt->execute()){
			echo "Insert address failed: (".$stmt->errno.")".$stmt->error;
			$return_code = 99;		//set unsuccessful return code
		} else {
	//		echo "Shipping added!";
			$return_code = 0;		//set succesful return code
			$_SESSION['shipping_id'] = $mysqli->insert_id;
		}
		// close statement
		$stmt->close();
}
/*
	Main logic of the program
*/
	define("SUCCESS", 0);
	$return_code = 0;	//initialize return code
	$i_fName;
	$i_street; 
	$i_city; 
	$i_state;
	$i_zipCode;
	$i_phone;
	$i_cid;
//	Validate full name
	if(isset($_POST['fName'])) {
		$i_fName = $_POST['fName'];
		if($i_fName != "") {	
	//		echo "fName: ".$i_fName;
		} else {
			$return_code = 99;			// invalid email
	//		echo "Missing 1";
		}
	} else {
		$return_code = 99;				// missing input
	//	echo "1 wasn't provided";
	}
//	Validate street
	if(isset($_POST['street'])) {
		$i_street = $_POST['street'];
		if($i_street != "") {	
	//		echo "street: ".$i_street;
		} else {
			$return_code = 99;			// invalid email
	//		echo "Missing 3";
		}
	} else {
		$return_code = 99;				// missing input
	//	echo "3 wasn't provided";
	}
//	Validate street
	if(isset($_POST['city'])) {
		$i_city = $_POST['city'];
		if($i_city != "") {	
	//		echo "city: ".$i_city;
		} else {
			$return_code = 99;			// invalid email
	//		echo "Missing 4";
		}
	} else {
		$return_code = 99;				// missing input
	//	echo "4 wasn't provided";
	}
//	Validate state
	if(isset($_POST['state'])) {
		$i_state = $_POST['state'];
		if($i_state != "") {	
	//		echo "state: ".$i_state;
		} else {
			$return_code = 99;			// invalid email
	//		echo "Missing 5";
		}
	} else {
		$return_code = 99;				// missing input
	//	echo "5 wasn't provided";
	}
//	Validate zipcode
	if(isset($_POST['zipCode'])) {
		$i_zipCode = $_POST['zipCode'];
		if($i_zipCode != "") {	
	//		echo "zipcode: ".$i_zipCode;
		} else {
			$return_code = 99;			// invalid email
	//		echo "Missing 6";
		}
	} else {
		$return_code = 99;				// missing input
	//	echo "6 wasn't provided";
	}
//	Validate phone
	if(isset($_POST['phone'])) {
		$i_phone = $_POST['phone'];
		if($i_phone != "") {	
	//		echo "phone: ".$i_phone;
		} else {
			$return_code = 99;			// invalid email
	//		echo "Missing 7";
		}
	} else {
		$return_code = 99;				// missing input
	//	echo "7 wasn't provided";
	}
//	get customer id from session storage
	$i_cid = $_SESSION['customer_id'];
//	echo "cid: ".$cid;
	if($i_cid === null || $i_cid == "" || $i_cid <= 0){
		$return_code = false;		
	//	echo "customer id is not available";
	}
//	If everything is good, add to the tables
	if($return_code === SUCCESS) {
	//	echo "Connecting to the database";
// 	Connecting to the database.
		$mysqli = new mysqli($dbhost, $dbuser, $dbpass, $dbname);
	
		if (mysqli_connect_error()) {
		    die('Connect Error (' . mysqli_connect_errno() . ') '
		            . mysqli_connect_error());
			$return_code = 99;			// set rc to fail
		} else {
			addShippingInfo($mysqli, $i_cid, $i_fName, $i_street, $i_city, $i_state, $i_zipCode, $i_phone, $return_code);
		}
		$mysqli->close();
	}
	echo $return_code;	
?>