function validateText(inputText) {
    var re = /^[a-zA-Z]+$/;
	return re.test(inputText);
}

function validateNum(inputText) {
    var re = /^[0-9]+$/;
	return re.test(inputText);
}
/*
	This function will add bio/shipping information to the customer database
*/
function addBioInfo(fName, street, city, state, zipCode, phone){
	var req = new XMLHttpRequest();
	if(!req) {
		throw "Unable to create HttpRequest.";
	}
//	var url = "add_bio.php";
	var parameters = "fName="+fName+"&street="+street+"&city="+city+"&state="+state+"&zipCode="+zipCode+"&phone="+phone;
	  	
	  		$(document).ready(function(){
		    var request = $.ajax({
		        type: "POST",
		        dataType: "text",
		        url: "add_bio.php",
		        async: false,
		        data: parameters
		     });
			
				request.done(function( msg ) {
  					if(msg=="0"){
 						alert("Shipping added!");
  					}
				});
		});	
/*
	req.onreadystatechange=function() {
		if(req.readyState===4) {
			var response = this.responseText;
 			if(response === "0") {
 				alert("Shipping added!");
 				//document.getElementById("addBioBtn").disabled = true;
 			} //else {
 			//	alert("PHP display: "+response);
				//alert("We're currently experience with some technical issue. Please come back at a later time to complete your purschase.");
 			//}
		}	
	}
	req.open("POST",url,true);
	req.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	req.send(parameters);
*/
}
/*
	This function will add payment information to the database
*/
function sendPayment(pType, pName, pNum, pMonth, pYear){
	var req = new XMLHttpRequest();
	if(!req) {
		throw "Unable to create HttpRequest.";
	}
//	var url = "add_payment.php";
	var parameters = "pType="+pType+"&pName="+pName+"&pNum="+pNum+"&pMonth="+pMonth+"&pYear="+pYear;
	  	
	  	$(document).ready(function(){
		    var request = $.ajax({
		        type: "POST",
		        dataType: "text",
		        url: "add_payment.php",
		        async: false,
		        data: parameters
		     });
			
				request.done(function( msg ) {
  					if(msg=="0"){
 						alert("Payment added!");
 						window.location.href="summary.php";
  					}
				});
		});	

/*
	req.onreadystatechange=function() {
		if(req.readyState===4) {
			var response = this.responseText;
 			if(response === "0") {
 				alert("Payment added!");
 				window.location.href="summary.php";
 			}// else {
 			//	alert("PHP display: "+response);
				//alert("We're currently experience with some technical issue. Please come back at a later time to complete your purschase.");
 			//}
		}	
	}
	req.open("POST",url,true);
	req.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	req.send(parameters);
*/
}
/*
	This function will add payment information
*/
function addPayment(){
	var pType = document.getElementById("cardType").value;
	var pName = document.getElementById("cardName").value;
	var pNum = document.getElementById("cardNumber").value;
	var pMonth = document.getElementById("expMonth").value;
	var pYear = document.getElementById("expYear").value;
	
	var valid_input = true;
	var valArray = [];
//	validate name
	if(pName === null || pName === "") {
		valArray.push("Name is required.");
		valid_input = false;
	} else if(!validateText(pName)) {
		valArray.push("Invalid name.");
		valid_input = false;
	}
//	validate card number
	if(pNum === null || pNum === "") {
		valArray.push("Card number is required.");
		valid_input = false;
	} else if(!validateNum(pNum)) {
		valArray.push("Invalid card number.");
		valid_input = false;
	}
//
	if(!valid_input || valArray.length > 0) {
		alert(valArray.join("\n"));
	} else {
		sendPayment(pType, pName, pNum, pMonth, pYear);
	}
}
/*
	This function will validate the user's shipping information
*/
function addBio(){
	var fName = document.getElementById("fullName").value;
	var street = document.getElementById("streetAddress").value;
	var city = document.getElementById("city").value;
	var state = document.getElementById("state").value;
	var zipCode = document.getElementById("zipCode").value;
	var phone = document.getElementById("phone").value;

	var valid_input = true;
	var valArray = [];
//	validate full name
	if(fName === null || fName === "") {
		valArray.push("Name is required.");
		valid_input = false;
	} else if(!validateText(fName)) {
		valArray.push("Invalid name.");
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
	}
//	validate state 
	if(state === null || state === "") {
		valArray.push("State is required.");
		valid_input = false;
	}
//	validate zip code 
	if(zipCode === null || zipCode === "") {
		valArray.push("Zip code is required.");
		valid_input = false;
	} else if(!validateNum(zipCode)) {
		valArray.push("Invalid zip code.");
		valid_input = false;
	}
//	validate phone
	if(phone === null || phone === "") {
		valArray.push("Phone number is required.");
		valid_input = false;
	} else if(!validateNum(phone)) {
		valArray.push("Invalid phone number.");
		valid_input = false;
	}
	
	if(!valid_input || valArray.length > 0) {
		alert(valArray.join("\n"));
	} else {
		addBioInfo(fName, street, city, state, zipCode, phone);
	}
}

