<!DOCTYPE html>
<html lang="en">
	<head>
		<title>Check-out</title>
		<link rel="stylesheet" href="css/bootstrap.css">
		<link rel="stylesheet" type="text/css" href="css/bootstrap.css">
		<script type="text/javascript" src="js/process.js"></script>
	</head>
	<body>
	<div class="container">
		<div class="jumbotron">
			<h2>CHECKOUT</h2>
		</div>
	</div>
	<?php
		session_start();
		$cid;
		if(!empty($_SESSION['customer_id'])) {
			$cid = $_SESSION['customer_id'];
		}
		echo "Customer id: ".$cid."</br>";
		if(!empty($_SESSION['valid_login'])) {
			$login_info = $_SESSION['valid_login'];
			echo "Login value: ".$login_info."</br>";
		}
		
	?>
	<div class="container">
		<div class="col-sm-5">
			<h4 class="text-center">Shipping Information</h4>
			<form id="shippingResult">
			  	<div class="form-group">
			    	<label for="firstName">First Name</label>
			    	<input type="text" class="form-control" id="firstName" placeholder="Jane">
			  	</div>	
			  	<div class="form-group">
			    	<label for="lastName">Last Name</label>
			    	<input type="text" class="form-control" id="lastName" placeholder="Doe">
			  	</div>		
			  	<div class="form-group">
			    	<label for="streetAddress">Street Address</label>
			    	<input type="text" class="form-control" id="streetAddress" placeholder="123 A Street">
			  	</div>		
			   	<div class="form-group">
			    	<label for="city">City</label>
			    	<input type="text" class="form-control" id="city" placeholder="Smallville">
			  	</div>		
			   	<div class="form-group">
			    	<label for="state">State</label>
			    	<input type="text" class="form-control" id="state" placeholder="Kansas">
			  	</div>		
			   	<div class="form-group">
			    	<label for="zipCode">Zip Code</label>
			    	<input type="text" class="form-control" id="zipCode" placeholder="90210">
			  	</div>		
			   	<div class="form-group">
			    	<label for="phone">Phone Number</label>
			    	<input type="text" class="form-control" id="phone" placeholder="1234560000">
			  	</div>		
			  	<button type="submit" class="btn btn-default" onclick="addBio()">Add</button>
			</form>
		</div>
		<div class="cols-sm-5 col-sm-offset-7">
			<h4 class="text-center">Payment Information</h4>
			<form id="paymentResult">
			  	<div class="form-group">
			    	<label for="cardType">Card Type</label>
			    	<input type="text" class="form-control" id="cardType" placeholder="VISA">
			  	</div>	
			  	<div class="form-group">
			    	<label for="cardName">Name on the card</label>
			    	<input type="text" class="form-control" id="cardName" placeholder="Jane Doe">
			  	</div>		
			  	<div class="form-group">
			    	<label for="cardNumber">Card Number</label>
			    	<input type="text" class="form-control" id="cardNumber" placeholder="123456">
			  	</div>		
			   	<div class="form-group">
			    	<label for="expMonth">Expiration Month</label>
			    	<input type="text" class="form-control" id="expMonth" placeholder="01">
			  	</div>		
			   	<div class="form-group">
			    	<label for="expYear">Expiration Year</label>
			    	<input type="text" class="form-control" id="expYear" placeholder="2020">
			  	</div>					  
			  	<button type="submit" class="btn btn-default" onclick="addPayment()">Submit order</button>
			</form>
		</div>
	</div>
	</body>
</html>