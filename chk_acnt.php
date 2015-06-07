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
	function genHash($inPW, $inSalt, &$hashValue){
		$hashValue = crypt($inPW, $inSalt);
	}
/*
	This function will get the salt value for the account.
*/
	function getSalt($mysqli, $inEmail, &$storedHash, &$outSalt, &$return_code){
	//	echo "In getSalt() - email is:'".$inEmail."'";
		// create a prepare statement 

		$stmt = $mysqli->prepare("SELECT hash_value, salt FROM top_secret WHERE email=?;");

		// bind parameters as string
		$stmt->bind_param("s",$inEmail);
		
		// execute the statement
		$stmt->execute();
		if(!$stmt->execute()){
			echo "Fail to query the table: (".$stmt->errno.")".$stmt->error;
			$return_code = 99;		//set unsuccessful return code
		} else {
		// bind result
			$stmt->bind_result($storedHash, $outSalt);
		// fetch value
			$stmt->fetch();
	//	echo "Salt is: ".$outSalt;
	//	echo "Stored hash is: ".$storedHash;
			$return_code = 0;		//set succesful return code
		}
		// close statement
		$stmt->close();
	}
/*
	This function will get the customer id if the password matched.
*/
	function getID($mysqli, $inEmail, &$return_code){
		session_start();
	//	echo "In getSalt() - email is:'".$inEmail."'";
		// create a prepare statement 

		$stmt = $mysqli->prepare("SELECT cid FROM customer_reference WHERE cust_email=?;");

		// bind parameters as string
		$stmt->bind_param("s",$inEmail);
		
		// execute the statement
		$stmt->execute();
		if(!$stmt->execute()){
			echo "Fail to query the table: (".$stmt->errno.")".$stmt->error;
			$return_code = 99;		//set unsuccessful return code
		} else {
		// bind result
			$stmt->bind_result($cid);
		// fetch value
			$stmt->fetch();
	//	echo "Customer id is: ".$cid;
		// store customer id into session
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
	$hashValue;
	$salt;
	$sHash;
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
	
	if($return_code === SUCCESS) {
// 	Connecting to the database.
		$mysqli = new mysqli($dbhost, $dbuser, $dbpass, $dbname);
	
		if (mysqli_connect_error()) {
		    die('Connect Error (' . mysqli_connect_errno() . ') '
		            . mysqli_connect_error());
			$return_code = 99;			// set rc to fail
		} else {
	//		echo "Ready for salt";
//	Getting the salt value from the database
			getSalt($mysqli, $inEmail, $sHash, $salt, $return_code);
//	Hash the password using salt
			if($return_code===SUCCESS) {
				genHash($inPW, $salt, $hashValue);
			}
			if($return_code===SUCCESS) {
				if($sHash === $hashValue){		//password match
	//				echo "Password match!";
					getID($mysqli, $inEmail, $return_code);
				} else {
	//				echo "Password not match!";
					$return_code = 1;
				}
			}
		}
//	close connection
		$mysqli->close();
	}
	echo $return_code;	//test for not found
?>