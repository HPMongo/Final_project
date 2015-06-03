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
	<!--script type="text/javascript" src="js/script.js"></script-->
	<script src="//code.jquery.com/jquery-1.11.3.min.js"></script>
	<script src="//code.jquery.com/jquery-migrate-1.2.1.min.js"></script>
	<script type="text/javascript">
	/*
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
		            //dataType: "json",
		        url: "view_cart.php",
		        data: settings,
		            //contentType: "application/json",
				success: function(response) {
					$("#result").html(response.itemID + "</br>" + response.itemDesc);
				//	var newSettings = 
				//	localStorage.setItem('newCart',JSON.stringify(newSettings));
				}
			});
		});	
	*/
	</script>
</head>
<body>
	<div class="container">
		<div class="page-header">
			<h3>Items in your cart:</h3>
		</div>
	</div>
	<div class="container" id="result" name="result">
		<?php
			include 'view_cart.php';
		?>
	</div>
</body>
</html>