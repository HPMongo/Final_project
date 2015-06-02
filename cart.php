<!DOCTYPE html>
<html lang="en">
<head>
	<title>Cart</title>
	<link rel="stylesheet" type="text/css" href="css/bootstrap.css">
	<!--script type="text/javascript" src="js/script.js"></script-->
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
		    $("#button").click(function(){
		    	$.ajax({
		            type: "POST",
		            dataType: "json",
		            url: "view_cart.php",
		            data: settings,
		            //contentType: "application/json",
					//success: function(msg, string, jqXHR) {
					//	$("#result").html(msg+string+jqXHR);
					//}
					function(data, status) {
						alert("Data: "+ data + "status: " + status);
					}
				});
		    });
		});
		
	</script>
</head>
<body>
	<div class="container">
		<div class="page-header">
			<h3>Items in your cart:</h3>
		</div>
		<input type="button" id="button" value="submit">
	</div>
	<div class="container" id="result" name="result">
	</div>
</body>
</html>