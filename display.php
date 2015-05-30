<?php
	include 'login.php';
	error_reporting(E_ALL);
	ini_set('display_error','On');
?>
<?php
//	Get data from the current inventory
	function getData($mysqli){
		// create a prepare statement 
		$stmt = $mysqli->prepare("SELECT id, description, category, quantities, price, pic_location FROM widgets WHERE quantities > 0;");
		
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

	function displayData($result){
		echo "Got to the display data";
		echo "<link rel='stytesheet' type ='text/css' href='css/bootstrap.css'>";
		while($row = $result->fetch_assoc()){
			$imgloc = $row['pic_location'];
			$desc = $row['description'];
			echo "<div class='container'>";
			echo "<img src='".$imgloc."' class='img-rounded' alt='' alt width='115' height='115'>";
			echo $desc."</br>";
			echo "</div>";
		}
	}
// 	Connecting to the database. If everything is good, call getData to
// 	display the current inventory

	echo "Got here!";
	$mysqli = new mysqli($dbhost, $dbuser, $dbpass, $dbname);
	
	if (mysqli_connect_error()) {
	    die('Connect Error (' . mysqli_connect_errno() . ') '
	            . mysqli_connect_error());
	} else {
		echo "Everythin is connected!";
		getData($mysqli);
	}
//	close connection
	$mysqli->close();
?>