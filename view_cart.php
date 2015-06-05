<?php
	include 'login.php';
	error_reporting(E_ALL);
	ini_set('display_error','On');
?>
<?php
//	Get price and description from the inventory
	function getData($mysqli, &$inJSON){
		// create a prepare statement 
		$stmt = $mysqli->prepare("SELECT id, description, price, quantities FROM widgets WHERE id=?;");
		$result;
		// iterate through the JSON object
		for($i=0; $i<count($inJSON->cart); $i++) {
			$inID = $inJSON->cart[$i]->itemID;
	///		echo "*".$inID."</br>";
			$inQty = $inJSON->cart[$i]->itemQty;
	///		echo "*".$inQty."</br>";

		// bind parameters
			$stmt->bind_param("i",$inID);
		// execute the statement
			$stmt->execute();
		// get result
			$result = $stmt->get_result();
		// store the data
			$row = $result->fetch_assoc();
			$o_id = $row['id'];
			$o_desc = $row['description'];
			$o_price = $row['price'];
			$o_qty = $row['quantities'];
			$tPrice = 0;
	///		echo "Output id: ".$o_id."</br>";
	///		echo "Output desc: ".$o_desc."</br>";
	///		echo "Output price: ".$o_price."</br>";
			if($o_qty < $inQty) {
	///			echo "Item is out of stock</br>";
				$inQty = 0;			// set request quantity to zero
			} else {
	///			echo "Output qty: ".$inQty."</br>";
	///			echo "</br>";		// do nothing here
			}
			$tPrice = $inQty * $o_price;
	///		echo "Total price: $".$tPrice."</br>";
		//	update 
			$inJSON->cart[$i]->itemDesc = $o_desc;
			$inJSON->cart[$i]->itemPrice = $o_price;
			$inJSON->cart[$i]->itemQty = $inQty;
			$inJSON->cart[$i]->itemTPrice = $tPrice;
		}
		// close statement
		$stmt->close();
	}

//	Get JSON input
	$request_body = file_get_contents('php://input');
//	$request_body = '{"cart":[{"itemID":6,"itemDesc":"","itemQty":61,"itemPrice":0,"itemTPrice":0},{"itemID":2,"itemDesc":"","itemQty":2,"itemPrice":0,"itemTPrice":0},{"itemID":3,"itemDesc":"","itemQty":4,"itemPrice":0,"itemTPrice":0},{"itemID":4,"itemDesc":"","itemQty":8,"itemPrice":0,"itemTPrice":0}]}';

	//$json = json_decode($request_body);

	$json = json_decode($request_body);
//	print_r($json);
//	echo "</br></br>";

// 	Connecting to the database. If everything is good, call getData to
// 	display the current inventory

	$mysqli = new mysqli($dbhost, $dbuser, $dbpass, $dbname);
	
	if (mysqli_connect_error()) {
	    die('Connect Error (' . mysqli_connect_errno() . ') '
	            . mysqli_connect_error());
	} else {
		getData($mysqli, $json);
///		echo "After the database call!"."</br>";
	}
//	close connection
	$mysqli->close();
///	print_r($json);
	$encodeJSON = json_encode($json);
//	print_r($encodeJSON);
	echo $encodeJSON;
?>