<!DOCTYPE html>
<html lang="en">
	<head>
		<title>Check-out</title>
		<link rel="stylesheet" href="css/bootstrap.css">
		<link rel="stylesheet" type="text/css" href="css/bootstrap.css">
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
		<form class="form-horizontal">
		  <div class="form-group">
		    <label for="inputFirstName" class="col-sm-2 control-label">First Name</label>
		    <div class="col-xs-4">
		      <input type="text" class="form-control" id="inputFirstName" placeholder="First Name">
		    </div>
		  </div>
		  <div class="form-group">
		    <label for="inputLastName" class="col-sm-2 control-label">Last Name</label>
		    <div class="col-xs-4">
		      <input type="text" class="form-control" id="inputLastName" placeholder="Last Name">
		    </div>
		  </div>
		  <div class="form-group">
		    <label for="inputStreetAddress" class="col-sm-2 control-label">Street Address</label>
		    <div class="col-xs-4">
		      <input type="text" class="form-control" id="inputStreetAddress" placeholder="123 1st Street">
		    </div>
		  </div>
		  <div class="form-group">
		    <label for="inputCity" class="col-sm-2 control-label">City</label>
		    <div class="col-xs-4">
		      <input type="text" class="form-control" id="inputCity" placeholder="City">
		    </div>
		  </div>
		  <div class="form-group">
		    <label for="inputState" class="col-sm-2 control-label">State</label>
		    <div class="col-xs-4">
		      <input type="text" class="form-control" id="inputState" placeholder="State">
		    </div>
		  </div>
		  <div class="form-group">
		    <label for="inputZipCode" class="col-sm-2 control-label">Zip Code</label>
		    <div class="col-xs-4">
		      <input type="text" class="form-control" id="inputZipCode" placeholder="12345">
		    </div>
		  </div>
		  <div class="form-group">
		    <label for="inputPhone" class="col-sm-2 control-label">Phone Number</label>
		    <div class="col-xs-4">
		      <input type="text" class="form-control" id="inputPhone" placeholder="5150001234">
		    </div>
		  </div>
		  <div class="form-group">
		    <div class="col-sm-offset-2 col-sm-10">
		      <button type="submit" class="btn btn-default">Add</button>
		    </div>
		  </div>
		</form>
	</div>
	</body>
</html>