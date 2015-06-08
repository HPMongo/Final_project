<!DOCTYPE html>
<html lang="en">
	<head>
		<title>Check-out</title>
		<link rel="stylesheet" href="css/bootstrap.css">
		<link rel="stylesheet" type="text/css" href="css/bootstrap.css">
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
			        url: "complete_order.php",
			        data: JSON.stringify(settings),
					success: function(response) {
						settings = {'cart':[]};			//create one and store it in local storage
						localStorage.setItem('userCart',JSON.stringify(settings));
					}
				});
			});	
		</script>
	</head>
	<body>
	<div class="container">
			<h2>SUMMARY</h2>
			<p>
				<a href="logout.php" class="btn btn-primary" role="button">LOG OUT</a>	
			</p>
	</div>
	<div class="container" id="confirmDiv" name="confirmDiv">
	</div>
	<div class="container" id="resultDiv" name="resultDiv">
		Your order is being processed - please hit refresh to receive the update.
		<?php
			include "history.php";
		?>
	</div>
	</body>
</html>