<!DOCTYPE html>
<html lang="en">
	<head>
		<title>Checkout_start</title>
		<link rel="stylesheet" type="text/css" href="css/bootstrap.css">
		<script src="//code.jquery.com/jquery-1.11.3.min.js"></script>
		<script src="//code.jquery.com/jquery-migrate-1.2.1.min.js"></script>
		<script type="text/javascript" src="js/validation.js"></script>
	</head>
	<body>
	<div class="container">
		<div class="jumbotron">
			<h2>LOG IN</h2>
		</div>
	</div>
	<div class="container">
		<div class="col-sm-5">
			<h4 class="text-center">Returning customers</h4>
			<form>
			  	<div class="form-group">
			    	<label for="inputEmail1">Email address</label>
			    	<input type="email" class="form-control" id="inputEmail1" placeholder="abc@abc.com">
			  	</div>
			  	<div class="form-group">
			    	<label for="inputPassword1">Password</label>
			    	<input type="password" class="form-control" id="inputPassword1" placeholder="Password">
			  	</div>			 
			  	<button type="submit" class="btn btn-default" onclick="validateLogin()">Log in</button>
			</form>
		</div>
		<div class="cols-sm-5 col-sm-offset-7">
			<h4 class="text-center">Create new account</h4>
			<form>
			  	<div class="form-group">
			    	<label for="inputEmail2">Email address</label>
			    	<input type="email" class="form-control" id="inputEmail2" placeholder="abc@abc.com">
			  	</div>
			  	<div class="form-group">
			    	<label for="inputPassword2">Password</label>
			    	<input type="password" class="form-control" id="inputPassword2" placeholder="Password">
			  	</div>			
			  	<div class="form-group">
			    	<label for="inputPassword3">Re-type Password</label>
			    	<input type="password" class="form-control" id="inputPassword3" placeholder="Password">
			  	</div>			  
			  	<button type="submit" class="btn btn-default" onclick="validateInput()">Create account</button>
			</form>
		</div>
	</div>
	</body>
</html>