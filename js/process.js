function validateText(inputText) {
    var re = /^[a-zA-Z]+$/;
	return re.test(inputText);
}

function validateNum(inputText) {
    var re = /^[0-9]+$/;
	return re.test(inputText);
}

/*
	This function will validate the user's shipping information
*/
function addBio(){
	var fName = document.getElementById("firstName").value;
	var lName = document.getElementById("lastName").value;
	var street = document.getElementById("streetAddress").value;
	var city = document.getElementById("city").value;
	var state = document.getElementById("state").value;
	var zipCode = document.getElementById("zipCode").value;
	var phone = document.getElementById("phone").value;

	var valid_input = true;
	var valArray = [];
//	validate first name
	if(fName === null || fName === "") {
		valArray.push("First name is required.");
		valid_input = false;
	} else if(!validateText(fName)) {
		valArray.push("Invalid first name.");
		valid_input = false;
	}
//	validate last name
	if(lName === null || lName === "") {
		valArray.push("Last name is required.");
		valid_input = false;
	} else if(!validateText(lName)) {
		valArray.push("Invalid last name.");
		valid_input = false;
	}
//	validate street address
	if(street === null || street === "") {
		valArray.push("Street address is required.");
		valid_input = false;
	}
//	validate city 
	if(city === null || city === "") {
		valArray.push("City is required.");
		valid_input = false;
	} else if(!validateText(city)) {
		valArray.push("Invalid city.");
		valid_input = false;
	}
//	validate state 
	if(state === null || state === "") {
		valArray.push("State is required.");
		valid_input = false;
	} else if(!validateText(state)) {
		valArray.push("Invalid state.");
		valid_input = false;
	}
//	validate zip code 
	if(zipCode === null || zipCode === "") {
		valArray.push("Zip code is required.");
		valid_input = false;
	} else if(!validateNume(zipCode)) {
		valArray.push("Invalid zip code.");
		valid_input = false;
	}
//	validate phone
	if(phone === null || phone === "") {
		valArray.push("Phone number is required.");
		valid_input = false;
	} else if(!validateNume(phone)) {
		valArray.push("You have entered an invalid phone number.");
		valid_input = false;
	}
	
	if(!valid_input) {
		alert(valArray.join("\n"));
	}
}

