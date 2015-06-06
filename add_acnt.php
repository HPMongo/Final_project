<?php
	include 'login.php';
	error_reporting(E_ALL);
	ini_set('display_error','On');
?>
<?php
/*	
	Hash the password and given salt value and pass it back to the calling function
	function.
*/
	function getHash($inPW, $inSalt, &$hashValue){
	//	echo "In addData()";
	//	echo "pw: ".$inPW;
	//	echo " inSalt: ".$inSalt;	
	//	echo " oldHash: ".$hashValue;
	
// Get the hash password
	$hashValue = crypt($inPW, $inSalt);
	}
/*	
	Add new account in the database
*/
	function addData($mysqli, $inEmail, $inHash, $inSalt, &$return_code){
	//	echo "In addData()";
	//	echo "email: ".$inEmail;
	//	echo " inHash: ".$inHash;
	//	echo " inSalt: ".$inSalt;

		// create a prepare statement 
		$stmt = $mysqli->prepare("INSERT into top_secret(email, hash_value, salt)VALUES(?,?,?)");
		
		// bind parameters as three strings
		$stmt->bind_param("sss",$inEmail, $inHash, $inSalt);
		
		// execute the statement
		if(!$stmt->execute()){
	//		echo "Insert account failed: (".$stmt->errno.")".$stmt->error;
			$return_code = 99;		//set unsuccessful return code
		} else {
	//		echo "Account added!";
			$return_code = 0;		//set succesful return code
		}
		// close statement
		$stmt->close();
	}
/*
	Add the relationship between the account and the customer.
*/
	function addRelation($mysqli, $inEmail, &$return_code){
	//	echo "In addRelation()";
	//	echo "email: ".$inEmail;

		// create a prepare statement 
		$stmt = $mysqli->prepare("INSERT into customer_reference(cust_email)VALUES(?)");
		
		// bind parameters as string
		$stmt->bind_param("s",$inEmail);
		
		// execute the statement
		if(!$stmt->execute()){
	//		echo "Insert relationship failed: (".$stmt->errno.")".$stmt->error;
			$return_code = 99;		//set unsuccessful return code
		} else {
	//		echo "Relation added!";
			$return_code = 0;		//set succesful return code
		}
		// close statement
		$stmt->close();
	}
/*
	Store customer id for subsequent process
*/
	function storeCustomerInfo($mysqli, $inEmail, &$return_code){
	//	echo "In storeCustomerInfo()";
	//	echo "email: ".$inEmail;

		// create a prepare statement 
		$stmt = $mysqli->prepare("SELECT cid FROM customer_reference WHERE cust_email=?");
		
		// bind parameters as string
		$stmt->bind_param("s",$inEmail);
		
		// execute the statement
		if(!$stmt->execute()){
			echo "Unable to retrieve customer id: (".$stmt->errno.")".$stmt->error;
			$return_code = 99;		//set unsuccessful return code
		} else {
		// store customer id to session
			$stmt->bind_result($cid);
			session_start();
			$_SESSION['customer_id'] = $cid;
			$_SESSION['valid_login'] = "YES";
			$return_code = 0;		//set succesful return code
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
	$inPW;
	$inSalt;
//	Validate email
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
//	Validate password
	if($return_code === SUCCESS && isset($_POST['pw'])) {
		$inPW = $_POST['pw'];
		if($inPW != "") {	
			$return_code = 0;			// everything is good
	//		echo "Got input password!";
		} else {
			$return_code = 99;			// invalid email
	//		echo "Invalid password";
		}
	} else {
		$return_code = 99;				// missing input
	//	echo "Missing password";
	}
//	Validate salt
	if($return_code === SUCCESS && isset($_POST['salt'])) {
		$inSalt = $_POST['salt'];
		if($inSalt != "") {	
			$return_code = 0;			// everything is good
	//		echo "Got input salt!";
		} else {
			$return_code = 99;			// invalid email
	//		echo "Invalid salt";
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
			$hashValue = 0;
			getHash($inPW, $inSalt, $hashValue);
	//		echo "Hash value is: ".$hashValue;
	//		echo " now connecting to the database.";
//	Create account data
			addData($mysqli, $inEmail, $hashValue, $inSalt, $return_code);
//	Add relationship
			if($return_code ===SUCCESS) {
				addRelation($mysqli, $inEmail, $return_code);
			}
//	Store customer information
			if($return_code ===SUCCESS){
				storeCustomerInfo($mysqli, $inEmail, $return_code);
			}
		}
//	close connection
		$mysqli->close();

	}
	echo $return_code;	
?>