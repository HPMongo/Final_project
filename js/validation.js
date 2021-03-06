/*
	This function will validate if the email is a valid email.
	The example was copied from "http://stackoverflow.com/questions/46155/validate-email-address-in-javascript" 
	on 06/05/2015.
*/
function ValidateEmail(inputText) {
    var re = /^([\w-]+(?:\.[\w-]+)*)@((?:[\w-]+\.)*\w[\w-]{0,66})\.([a-z]{2,6}(?:\.[a-z]{2})?)$/i;
	return re.test(inputText);
}
/*
	This function will generate a random string that will be used as a salt value in the database.
	The example was copied from "http://stackoverflow.com/questions/1349404/generate-a-string-of-5-random-characters-in-javascript"
	on 06/06/2015.
*/
function getRandValue() {
	var rVal = Math.random().toString(36).substring(7);
	return rVal;
}
/*
	This function will add a new account using the user's input. 
*/
function validateAccount(inEmail, inPW) {
	var req = new XMLHttpRequest();
	if(!req) {
		throw "Unable to create HttpRequest.";
	}
	//var url = "chk_acnt.php";
	var parameters = "email="+inEmail+"&pw="+inPW;

	  		$(document).ready(function(){
		    var request = $.ajax({
		        type: "POST",
		        dataType: "text",
		        url: "chk_acnt.php",
		        async: false,
		        data: parameters
		     });
			
				request.done(function( msg ) {
  					if(msg=="0"){
  					//	var url = "checkout.php";
  					//	$(location).attr('href',url);
 		 				window.location.href="checkout.php";
  					} else {
  						alert("Incorrect password.");
  					}
				});
		});	

/*
	req.onreadystatechange=function() {
		if(req.readyState==4) {
			var response = this.responseText;
 			if(response === "0") {
 				window.location.href="checkout.php";
 			} else if(response == "1") {
				alert("Incorrect password. Please try again.");
 			} else {
 			//	alert("PHP display:"+response);
				alert("We're currently experience with some technical issue. Please try again in 30 seconds.");
 			}
		}	
	}
	req.open("POST",url,true);
	req.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	req.send(parameters);
*/
}

/*
	This function will send a POST request to the account validation.
*/
function addAccount(inEmail, inPW, inSalt) {
	var req = new XMLHttpRequest();
	if(!req) {
		throw "Unable to create HttpRequest.";
	}
//	var url = "add_acnt.php";
	var parameters = "email="+inEmail+"&pw="+inPW+"&salt="+inSalt;
	  		$(document).ready(function(){
		    var request = $.ajax({
		        type: "POST",
		        dataType: "text",
		        url: "add_acnt.php",
		        async: false,
		        data: parameters
		     });
			
				request.done(function( msg ) {
  					if(msg=="0"){
 		 				window.location.href="checkout.php";
  					} else if(msg=="1"){
						alert("This email has been registered. Please use the registered information to log in.");
  					} else {
  						alert("We're currently experience with some technical issue. Please try again in 30 seconds.");
  					}
				});
		});	
/*
	req.onreadystatechange=function() {
		if(req.readyState==4) {
			var response = this.responseText;
 			if(response === "0") {
 		 		window.location.href="checkout.php";
 			} else if(response === "1") {
				alert("This email has been registered. Please use the registered information to log in.");
 			} else {
 			//	alert("PHP display:"+response);
				alert("We're currently experience with some technical issue. Please try again in 30 seconds.");
 			}
		}	
	}
	req.open("POST",url,true);
	req.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	req.send(parameters);
*/
}
/*
	This function will validate the user's email and passwords.
*/
function validateInput(){
	var inEmail = document.getElementById("inputEmail2").value;
	var in_pw1 = document.getElementById("inputPassword2").value;
	var in_pw2 = document.getElementById("inputPassword3").value;
	var valid_input = true;
	var salt = "a0b1c3";

//	Validate that email is entered
	if(inEmail === null || inEmail === "") {
		alert("A valid email is needed!");
		valid_input = false;
	}
//	Validate email format
	if(valid_input) {
		if(!ValidateEmail(inEmail)) {
			alert("You have entered an invalid email address!");
			valid_input = false;
		}
	}
//	Validate that password is entered
	if(valid_input) {
		if(in_pw1 === null || in_pw1 === "") {
			alert("A valid password is needed!");
			valid_input = false;
		}
	}
//	Validate that confirmation password is entered
	if(valid_input) {
		if(in_pw2 === null || in_pw2 === "") {
			alert("A confirmation password is needed!");
			valid_input = false;
		}
	}
//	Validate that the passwords are the same
	if(valid_input) {
		if(in_pw1 !== in_pw2) {
			alert("The passwords are not matching. Please re-check your passwords.");
			valid_input = false;
		}
	}
//	Generate a random salt value to store in the database
	if(valid_input) {
		salt = getRandValue();
	//	alert("The number is: " + salt);
	}
//	Call account validation to perform the rest of the processing
	if(valid_input) {
		addAccount(inEmail, in_pw1, salt);	
	}

}

/*
	This function will validate the user's login email and password.
*/
function validateLogin(){
	var inEmail = document.getElementById("inputEmail1").value;
	var in_pw1 = document.getElementById("inputPassword1").value;
	var valid_input = true;

//	Validate that email is entered
	if(inEmail === null || inEmail === "") {
		alert("A valid email is needed!");
		valid_input = false;
	}
//	Validate email format
	if(valid_input) {
		if(!ValidateEmail(inEmail)) {
			alert("You have entered an invalid email address!");
			valid_input = false;
		}
	}
//	Validate that password is entered
	if(valid_input) {
		if(in_pw1 === null || in_pw1 === "") {
			alert("A valid password is needed!");
			valid_input = false;
		}
	}
//	Call account validation to perform the rest of the processing
	if(valid_input) {
		validateAccount(inEmail, in_pw1);	
	}

}

