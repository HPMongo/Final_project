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
		$hashValue = crypt($inPW, $inSalt);
	}
/*	
	Add new account in the database
*/
	function addData($mysqli, $inEmail, $inHash, $inSalt, &$return_code){
		// create a prepare statement 
		$stmt = $mysqli->prepare("INSERT into top_secret(email, hash_value, salt)VALUES(?,?,?)");
		
		// bind parameters as three strings
		$stmt->bind_param("sss",$inEmail, $inHash, $inSalt);
		
		// execute the statement
		if(!$stmt->execute()){
			echo "Insert account failed: (".$stmt->errno.")".$stmt->error;
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
		session_start();
	//	echo "In addRelation()";
	//	echo "email: ".$inEmail;

		// create a prepare statement 
		$stmt = $mysqli->prepare("INSERT into customer_reference(cust_email)VALUES(?)");
		
		// bind parameters as string
		$stmt->bind_param("s",$inEmail);
		
		// execute the statement
		if(!$stmt->execute()){
			echo "Insert relationship failed: (".$stmt->errno.")".$stmt->error;
			$return_code = 99;		//set unsuccessful return code
		} else {
	//		echo "Relation added!";
			$return_code = 0;		//set succesful return code
		}

		$cust_id = $mysqli->insert_id;
		// store customer id to session
		//echo "Customer id is: ".$cust_id."/";

		$_SESSION['customer_id'] = $cust_id;
		$_SESSION['valid_login'] = "YES";
		
		// close statement
		$stmt->close();
	}
/*
	Get data from the customer reference table
*/
	function getData($mysqli, $inEmail, &$return_code){
	//	echo "In getData() - email is:'".$inEmail."'";
		// create a prepare statement 
		$stmt = $mysqli->prepare("SELECT cid FROM customer_reference WHERE cust_email=?");

		// bind parameters as string
		$stmt->bind_param("s",$inEmail);
		
		// execute the statement
		$stmt->execute();
		
		// get result
		$result = $stmt->get_result();

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
//	Check to see if the account exists in the database
			$hashValue = 0;
			getData($mysqli, $inEmail, $return_code);
	//		echo "B4 calling hash. rc is: ".$return_code;
			if($return_code===SUCCESS){
	//			echo "Inn hash";
				getHash($inPW, $inSalt, $hashValue);
	//			echo "after hash";
			}
	//		echo "newhash is: ".$hashValue;
//	Create account data
			if($return_code===SUCCESS){
				addData($mysqli, $inEmail, $hashValue, $inSalt, $return_code);
			}
//	Add relationship
			if($return_code ===SUCCESS) {
				addRelation($mysqli, $inEmail, $return_code);
			}
		}
//	close connection
		$mysqli->close();
	}
	echo $return_code;	
?>