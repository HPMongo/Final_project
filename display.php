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
/*
	This function will display the items in the inventory and allow the user to add items to the shopping
	cart.
*/
	function displayData($result){
		//echo "<link rel='stytesheet' type ='text/css' href='css/bootstrap.css'>";
		echo "<div class='container'>";
		echo "<table class='table'>";
		echo "<tr><th>Item</th><th>Item description</th><th>Quantity available</th><th>Price</th>";
		echo "<th>Quantity order</th></tr>";
		while($row = $result->fetch_assoc()){
			$id = $row['id'];
			$imgloc = $row['pic_location'];
			$desc = $row['description'];
			$qty = $row['quantities'];
			$price = $row['price'];
			$maxDisplay = 30;
			$moreThan30 = true;
		//	get max items to display - limit this to 30 items max
			if($qty < $maxDisplay) {
				$maxDisplay = $qty;
				$moreThan30 = false;
			}
			echo "<tr>";
			echo "<td><img src='".$imgloc."' class='img-rounded' alt='' alt width='115' height='115'></td>";
			echo "<td>".$desc."</td>";
			if($moreThan30) {
				echo "<td> 30+ available</td>";
			} else {
				echo "<td>".$qty." available</td>";
			}	
			echo "<td>$".$price."</td>";
			echo "<td>";
			echo "<form><select name='qty".$id."' id='qty".$id."'>";
			for($i = 1; $i <= $maxDisplay;$i++) {
				echo "<option value='".$i."'>".$i."</option>";
			}
			echo "</select></br>";
			echo "<input type='submit' value='Add to cart' onclick='addToCart(".$id.")'></form>";
			echo "</td>";
			echo "</tr>";
		}
		echo "</table>";
		echo "</div>";
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