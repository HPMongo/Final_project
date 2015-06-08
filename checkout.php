<!DOCTYPE html>
<html lang="en">
	<head>
		<title>Check-out</title>
		<link rel="stylesheet" href="css/bootstrap.css">
		<link rel="stylesheet" type="text/css" href="css/bootstrap.css">
		<script type="text/javascript" src="js/process.js"></script>
		<script src="//code.jquery.com/jquery-1.11.3.min.js"></script>
		<script src="//code.jquery.com/jquery-migrate-1.2.1.min.js"></script>
		<?php
		session_start();
		ob_start();
		$cid;
		if(!empty($_SESSION['valid_login'])) {
			$login_info = $_SESSION['valid_login'];
	//		echo "Login value: ".$login_info."</br>";
			if($login_info != "YES"){
				ob_end_clean();
				echo '<meta http-equiv="refresh" content=".01;url=index.php" />';
			}
		} else {
			ob_end_clean();
			echo '<meta http-equiv="refresh" content=".01;url=index.php" />';
		}
		?>
	</head>
	<body>
	<div class="container">
		<div class="jumbotron">
			<h2>CHECKOUT</h2>
		</div>
	</div>
	<div class="container">
		<div class="col-sm-5">
			<h4 class="text-center">Shipping Information</h4>
			<form id="shippingResult">
			  	<div class="form-group">
			    	<label for="fullName">Name</label>
			    	<input type="text" class="form-control" id="fullName" placeholder="Jane Doe">
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
			  	<div class="form-group">		
			  		<button type="submit" class="btn btn-default" id="addBioBtn" onclick="addBio()">Add</button>
			  	</div>	
			</form>
		</div>
		<div class="cols-sm-5 col-sm-offset-7">
			<h4 class="text-center">Payment Information</h4>
			<form id="paymentResult">
			  	<div class="form-group">
			    	<label for="cardType">Card Type</label>
			    	<!--input type="text" class="form-control" id="cardType" placeholder="VISA"-->
			    	<select name="cardType" id="cardType">
			    		<option value="1">Visa</option>
			    		<option value="2">American Express</option>
			    		<option value="3">Discover</option>
			    		<option value="4">Mastercard</option>
			    	</select>
			  	</div>	
			  	<div class="form-group">
			    	<label for="cardName">Name</label>
			    	<input type="text" class="form-control" id="cardName" placeholder="Jane Doe">
			  	</div>		
			  	<div class="form-group">
			    	<label for="cardNumber">Card Number</label>
			    	<input type="text" class="form-control" id="cardNumber" placeholder="123456">
			  	</div>		
			   	<div class="form-group">
			    	<label for="expMonth">Expiration Month</label>
			    	<!--input type="text" class="form-control" id="expMonth" placeholder="01"-->
			    	<select name="expMonth" id="expMonth">
			    		<option value="1">1</option>
			    		<option value="2">2</option>
			    		<option value="3">3</option>
			    		<option value="4">4</option>
			    		<option value="5">5</option>
			    		<option value="6">6</option>
			    		<option value="7">7</option>
			    		<option value="8">8</option>
			    		<option value="9">9</option>
			    		<option value="10">10</option>
			    		<option value="11">11</option>
			    		<option value="12">12</option>
			    	</select>
			  	</div>		
			   	<div class="form-group">
			    	<label for="expYear">Expiration Year</label>
			    	<!--input type="text" class="form-control" id="expYear" placeholder="2020"-->
			    	<select name="expYear" id="expYear">
			    		<option value="2015">2015</option>
			    		<option value="2016">2016</option>
			    		<option value="2017">2017</option>
			    		<option value="2018">2018</option>
			    		<option value="2019">2019</option>
			    		<option value="2020">2020</option>
			    		<option value="2021">2021</option>
			    		<option value="2022">2022</option>
			    		<option value="2023">2023</option>
			    		<option value="2024">2024</option>
			    		<option value="2025">2025</option>
			    	</select>
			  	</div>					  
			  	<button type="submit" class="btn btn-default" id="addPmtBtn" onclick="addPayment()">Submit order</button>
			</form>
		</div>
	</div>
	</body>
</html>