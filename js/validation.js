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
	This function will validate the user's email and passwords.
*/
function validateInput(){
	var inEmail = document.getElementById("inputEmail2").value;
	var in_pw1 = document.getElementById("inputPassword2").value;
	var in_pw2 = document.getElementById("inputPassword3").value;
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

	if(valid_input) {
		var salt = getRandValue();
		alert("The number is: " + salt);
	}
}
