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
function addPaymentInfo($mysqli, $i_cid, $i_pType, $i_pName, $i_pNum, $i_pMonth,$i_pYear, &$return_code) {
		//Add shipping information
		$stmt = $mysqli->prepare("INSERT into payment_detail(cid, card_name, card_type, card_number, card_exp_mo, card_exp_yr)VALUES(?,?,?,?,?,?)");
		// bind parameters
		$stmt->bind_param("isiiii",$i_cid, $i_pName, $i_pType, $i_pNum, $i_pMonth, $i_pYear);
		// execute the statement
		if(!$stmt->execute()){
			echo "Insert payment failed: (".$stmt->errno.")".$stmt->error;
			$return_code = 99;		//set unsuccessful return code
		} else {
//			echo "Payment added!";
			$return_code = 0;		//set succesful return code
			$_SESSION['payment_id'] = $mysqli->insert_id;
			$_SESSION['order_status'] = 1;	//payment received
		}
		// close statement
		$stmt->close();
}
/*
	Main logic of the program
*/
	define("SUCCESS", 0);
	$return_code = 0;	//initialize return code

	$i_pType;
	$i_pName;
	$i_pNum;
	$i_pMonth;
	$i_pYear;
//	get customer id from session storage
	$i_cid = $_SESSION['customer_id'];
//	echo "cid: ".$i_cid;
	if($i_cid === null || $i_cid == "" || $i_cid <= 0){
		$return_code = false;		
	}
//	Validate payment type
	if(isset($_POST['pType'])) {
		$i_pType = $_POST['pType'];
		if($i_pType != "") {	
//			echo "pType: ".$i_pType;
		} else {
			$return_code = 99;			
//			echo "Missing 1";
		}
	} else {
		$return_code = 99;				// missing input
//		echo "1 wasn't provided";
	}
//	Validate payment name
	if(isset($_POST['pName'])) {
		$i_pName = $_POST['pName'];
		if($i_pName != "") {	
//			echo "pName: ".$i_pName;
		} else {
			$return_code = 99;			 
//			echo "Missing 2";
		}
	} else {
		$return_code = 99;				// missing input
//		echo "2 wasn't provided";
	}
//	Validate payment number
	if(isset($_POST['pNum'])) {
		$i_pNum = $_POST['pNum'];
		if($i_pNum != "") {	
//			echo "pNum: ".$i_pNum;
		} else {
			$return_code = 99;			 
//			echo "Missing 3";
		}
	} else {
		$return_code = 99;				// missing input
//		echo "3 wasn't provided";
	}
//	Validate exp month
	if(isset($_POST['pMonth'])) {
		$i_pMonth = $_POST['pMonth'];
		if($i_pMonth!= "") {	
//			echo "pMonth: ".$i_pMonth;
		} else {
			$return_code = 99;			 
//			echo "Missing 4";
		}
	} else {
		$return_code = 99;				// missing input
//		echo "4 wasn't provided";
	}
//	Validate exp year 
	if(isset($_POST['pYear'])) {
		$i_pYear = $_POST['pYear'];
		if($i_pYear != "") {	
//			echo "pYear: ".$i_pYear;
		} else {
			$return_code = 99;			 
//			echo "Missing 5";
		}
	} else {
		$return_code = 99;				// missing input
//		echo "5 wasn't provided";
	}
//	If everything is good, add to the tables
	if($return_code === SUCCESS) {
		$mysqli = new mysqli($dbhost, $dbuser, $dbpass, $dbname);
	
		if (mysqli_connect_error()) {
		    die('Connect Error (' . mysqli_connect_errno() . ') '
		            . mysqli_connect_error());
			$return_code = 99;			// set rc to fail
		} else {
			addPaymentInfo($mysqli, $i_cid, $i_pType, $i_pName, $i_pNum, $i_pMonth, $i_pYear, $return_code);
		}
		$mysqli->close();
	}
	echo $return_code;	
?>