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
	<script type="text/javascript" src="js/script.js"></script>
</head>
<body>
	<div class="container">
		<div class="page-header">
			<h3>Items in your cart:</h3>
		</div>
	</div>
	<div class="container">
		<table class="table">
			<tr>
				<th>Item description</th>
				<th>Quantity</th>
				<th>Price</th>
				<th>Total</th>
			</tr>
			<tr>Total</tr>
		<?php 
			//include 'display.php';
			echo "Display detail here";
		?>
		</table>
	</div>
</body>
</html>