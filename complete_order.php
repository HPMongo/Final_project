<?php
	include 'login.php';
	error_reporting(E_ALL);
	ini_set('display_error','On');
?>
<?php
/*
	This function will create the order number and add all the detail to it
*/
	function completeOrder($mysqli, $inJSON, $cid, $shipping_id, $payment_id, &$return_code, &$order_num){
		// create a prepare statement 
		$stmt = $mysqli->prepare("INSERT INTO order_info(order_date, cid, order_status, order_total, shipping_id, payment_id) VALUES(NOW(),?,?,?,?,?)");
		$totalPrice = 0;
		// iterate through the JSON object
		for($i=0; $i<count($inJSON->cart); $i++) {
			$totalPrice += $inJSON->cart[$i]->itemTPrice;
		}
	//	echo "total price: ".$totalPrice;
		$default_status = "Order received";

		// bind parameters
			$stmt->bind_param("isiii",$cid, $default_status, $totalPrice, $shipping_id, $payment_id);
		// execute the statement
		if(!$stmt->execute()){
//			echo "Insert order failed: (".$stmt->errno.")".$stmt->error;
			$return_code = 99;		//set unsuccessful return code
		} else {
//			echo "Order added!";
			$return_code = 0;		//set succesful return code
			$order_num = $mysqli->insert_id;
		}
		// close statement
		$stmt->close();
	}
/*
	This function will add detail for the items
*/
function addDetail($mysqli, $inJSON, $order_num, &$return_code){
		// create a prepare statement 
		$stmt = $mysqli->prepare("INSERT INTO order_detail(order_id, wid, item_qty) VALUES(?,?,?)");
		// iterate through the JSON object
		for($i=0; $i<count($inJSON->cart); $i++) {
			$wid = $inJSON->cart[$i]->itemID;
			$item_qty = $inJSON->cart[$i]->itemQty;
		// bind parameters
			$stmt->bind_param("iii",$order_num, $wid, $item_qty);
		// execute the statement
			$stmt->execute();
		}
		// close statement
		$stmt->close();
		// Update order status to 0 so that it wouldn't process again
		$_SESSION['order_status'] = 0;
	}

/*
	Main logic of the program
*/
	define("SUCCESS", 0);
	$return_code = 0;	//initialize return code
	$order_num = 0;
	$cid;
	$login_info;
	$shipping_id;
	$payment_id;
//	
//	Get JSON input
	$request_body = file_get_contents('php://input');
//	$request_body = '{"cart":[{"itemID":4,"itemDesc":"Music box","itemQty":3,"itemPrice":3,"itemTPrice":9},{"itemID":5,"itemDesc":"Modern flower painting","itemQty":1,"itemPrice":5,"itemTPrice":5},{"itemID":6,"itemDesc":"Sport watch","itemQty":4,"itemPrice":50,"itemTPrice":200},{"itemID":1,"itemDesc":"Set of three golf balls","itemQty":9,"itemPrice":2,"itemTPrice":18}]}';
	$json = json_decode($request_body);
	//print_r($json);
//
//	get session info
//
	session_start();
	if(!empty($_SESSION['customer_id'])) {
		$cid = $_SESSION['customer_id'];
//		echo "Customer id: ".$cid;
	}
	if(!empty($_SESSION['valid_login'])) {
		$login_info = $_SESSION['valid_login'];
//		echo "Login value: ".$login_info;
	}
	if(!empty($_SESSION['shipping_id'])) {
		$shipping_id = $_SESSION['shipping_id'];
//		echo "Shipping id: ".$shipping_id;
	}		
	if(!empty($_SESSION['payment_id'])) {
		$payment_id = $_SESSION['payment_id'];
//		echo "Payment id: ".$payment_id;
	}	
	if(!empty($_SESSION['order_status'])) {
		$order_status = $_SESSION['order_status'];	// 1 is payment receive
//		echo "Order status: ".$order_status;
	}	
	if($order_status === 1) {
//
// 	Connecting to the database. If everything is good, process order to complete the order
//
		$mysqli = new mysqli($dbhost, $dbuser, $dbpass, $dbname);
	
		if (mysqli_connect_error()) {
		    die('Connect Error (' . mysqli_connect_errno() . ') '
		            . mysqli_connect_error());
		} else {
			completeOrder($mysqli, $json, $cid, $shipping_id, $payment_id, $return_code, $order_num);
			if($return_code===SUCCESS){
				addDetail($mysqli, $json, $order_num, $return_code);
			}
		}
//	close connection
		$mysqli->close();
	}
		$encodeJSON = json_encode(array("rc" => $return_code, "confirmation" => $order_num));
		echo $encodeJSON;
?>