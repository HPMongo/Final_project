<?php
	include 'login.php';
	error_reporting(E_ALL);
	ini_set('display_error','On');
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<title>Widgetstastic</title>
	<link rel="stylesheet" type="text/css" href="css/bootstrap.css">
</head>
<body>
	<div class="container">
		<div class="page-header">
			<div class="jumbotron">
			<h1>Widgets-tastic</h1>
			<h3>Awesome widgets at an awesomer price!</h3>
			</div>
		</div>
	</div>
	<div class="container">
		<h4 class="text-center">Here are the features of the day</h4>
		<?php 
			include 'display.php';
		?>
	</div>
</body>
</html>