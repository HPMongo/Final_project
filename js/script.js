var settings = null; 	//setting from local storage

function getID() {
	return this.itemID;
}

function getQty() {
	return this.itemQty;
}

function itemDetail(inID, inQty) {
	this.itemID = inID;
	this.itemQty = inQty;
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
	console.log(qty);
//	transform the item to an object
	var newItem = new itemDetail(inID, qty);
//	add it to the setting
	settings.cart.push(newItem);
//	store it to local storage
	localStorage.setItem('userCart', JSON.stringify(settings));
}
/*
	This function will display the current items in the cart
*/
function displayCart() {
	var items = 0;
	settings.cart.forEach(function(s) {
		items =+ s.itemQty;
	});
	if(typeof items !=='number' || items <= 0) {
		items = 0;
	}
	document.getElementById("shoppingCart").innerHTML = "Cart: " + items;
}

/*
	This function will load existing items from the local storage or create one if it doesn't exist
*/
window.onload = function() {
	var shoppingCart = localStorage.getItem('userCart');
	if(shoppingCart === null) { 		//cart doesn't exist
		settings = {'cart':[]};			//create one and store it in local storage
		localStorage.setItem('userCart',JSON.stringify(settings));
		displayCart();
	} else {
		settings = JSON.parse(localStorage.getItem('userCart'));
		displayCart();
	}

}
