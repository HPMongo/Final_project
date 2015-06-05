<?php
	include 'login.php';
	error_reporting(E_ALL);
	ini_set('display_error','On');
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<title>Cart</title>
	<link rel="stylesheet" type="text/css" href="css/bootstrap.css">
	<script src="//code.jquery.com/jquery-1.11.3.min.js"></script>
	<script src="//code.jquery.com/jquery-migrate-1.2.1.min.js"></script>
	<script type="text/javascript">
	
	//	get cart information
		var settings = null;
		var shoppingCart = localStorage.getItem('userCart');
		if(shoppingCart === null) { 		//cart doesn't exist
			settings = {'cart':[]};			//create one and store it in local storage
			localStorage.setItem('userCart',JSON.stringify(settings));
		} else {
			settings = JSON.parse(localStorage.getItem('userCart'));
		}
	//
  		$(document).ready(function(){
		    $.ajax({
		        type: "POST",
		        dataType: "json",
		        url: "view_cart.php",
		        data: JSON.stringify(settings),
				success: function(response) {
				//Populate table
					var output = "<table class='table table-striped'><tbody><tr><th>Item description</th><th>Quantity order</th><th>Unit price</th><th>Total</th></tr>";		
					var total = 0;
					$(response.cart).each(function(){
						var displayQty = this.itemQty;
						if(displayQty === 0) {
							displayQty = "Out of stock";
						}
						output += "<tr><td>" + this.itemDesc + "</td><td>" + displayQty + "</td><td>$" + this.itemPrice + "</td><td>$" + this.itemTPrice +"</td></tr>";
						total += this.itemTPrice;
					})
					output += "<tf><tr class='success'><td colspan='3'><strong>Total</strong></td><td><strong>$" + total + "</strong></td></tr>"
				$("#result").append(output);
		    	//	Replace existing cart with updated values
					var newSettings = response;
					localStorage.setItem('newCart',JSON.stringify(newSettings));
				}
			});
		});	
	
	</script>
</head>
<body>
	<div class="container">
		<div class="page-header">
			<h3>Items in your cart:</h3>
		</div>
	</div>
	<div class="container" id="result" name="result">
	</div>
</body>
</html>