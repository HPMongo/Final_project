var settings = null; 	//setting from local storage

function getID() {
	return this.itemID;
}

function getQty() {
	return this.itemQty;
}

function itemDetail(inID, inQty) {
	this.itemID = inID;
	this.itemDesc = "";		//blank at the time of adding the item to the cart
	this.itemQty = inQty;
	this.itemPrice = 0.0;	//set to zero at the time of adding the item to the cart
	this.itemTPrice = inQty * this.itemPrice;
	this.getID = getID;
	this.getQty = getQty;
}

/*
	This function will get the quality of the item selected, convert that to integer and return
	it back to the calling function.
*/
function getQty(inID) {
	var elementId = "qty"+inID;
	var qty = document.getElementById(elementId).value;
	qty = Number(qty);
	return qty;
}

function addToCart(inID) {
	var qty = getQty(inID);
	var itemExists = false;
//	transform the item to an object
	var newItem = new itemDetail(inID, qty);
//	search to see if the item already exist; update the quantity if it does, otherwise add it to the 
//  list
	for(var i = 0; i < settings.cart.length; i++) {
		if(inID === settings.cart[i].itemID) {
			settings.cart[i].itemQty = qty;
			itemExists = true;
			break;
		}
	}
//	add it to the setting
	if(!itemExists) {
		settings.cart.push(newItem);
	}
//	store it to local storage
	localStorage.setItem('userCart', JSON.stringify(settings));
}
/*
	This function will display the total number of items in the cart
*/
function displayCart() {
	var items = 0;
	settings.cart.forEach(function(s) {
		items = items + s.itemQty;
		console.log(s.itemQty);
	});
	if(typeof items !=='number' || items <= 0) {
		items = 0;
	}
	document.getElementById("shoppingCart").innerHTML ="<a href='cart.php'><strong>Items in cart: </strong></a>" + items;
}

/*
	This function will get the cart detail from local storage
*/
function getCart() {
	var shoppingCart = localStorage.getItem('userCart');
	if(shoppingCart === null) { 		//cart doesn't exist
		settings = {'cart':[]};			//create one and store it in local storage
		localStorage.setItem('userCart',JSON.stringify(settings));
	} else {
		settings = JSON.parse(localStorage.getItem('userCart'));
	}
}
/*
	This function will load existing items from the local storage or create one if it doesn't exist
*/
window.onload = function() {
	getCart();
	displayCart();
}
