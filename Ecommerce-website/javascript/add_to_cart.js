//Get cart from session storage or create one if it does not exist
function getCart_items() {
    let cart;
    if (sessionStorage.cart === undefined || sessionStorage.cart === "") {
        cart = [];
    }
    else {
        cart = JSON.parse(sessionStorage.cart);
    }
    return cart;
}


function addToCart(prodID, custID, prodImg, prodModel, prodPrice, prodstock) {
    console.log(localStorage.length)
    if (localStorage.length !== 0){
        let cart = getCart_items();
        let updated = false;
        //check if cart is empty then add product
        if (cart.length === 0) {
            cart.push({ id: prodID, customer: custID, img: prodImg, model: prodModel, price: prodPrice, quantity: 1, stock:prodstock-1});
            //Store in local storage
            sessionStorage.cart = JSON.stringify(cart);
        }

        else {
            //check if product already added to cart then increment quantity
            for (let i = 0; i < cart.length; i++) {
                if (prodID === cart[i].id) {
                    cart[i].quantity += 1;
                    cart[i].stock -= 1;
                    updated = true;
                    sessionStorage.cart = JSON.stringify(cart);
                }
            }

            if (updated === false) {
                cart.push({ id: prodID, customer: custID, img: prodImg, model: prodModel, price: prodPrice, quantity: 1, stock:prodstock});
                sessionStorage.cart = JSON.stringify(cart);
            }
        }
        //display message when product is added
        alert("Product added to cart");
        location.reload();
    }
    else{
        alert('Log in to Add to Cart');
        document.location.href = '../php/login.php';
    }


}

function deleteProduct(prodID) {
    let cart = getCart_items();
    //search for product to be removed by id
    for (let i = 0; i < cart.length; i++) {
        if (prodID === cart[i].id) {
            cart.splice(i, 1);
        }
    }

    sessionStorage.cart = JSON.stringify(cart);
    alert("Item removed from cart");
    location.reload();

}

function displayRecommendation(){
$.ajax({
  url: "recommendation.php",
  success: function(data) {
    var products = JSON.parse(data);
	var productList = "";
	for (var i = 0; i < products.length; i++) {
	  productList += '<div class="col">' +
		'<div class="card">' +
		  '<img src="' + products[i].img_src + '" class="card-img-top">' +
		  '<div class="card-body">' +
			'<h5>' + products[i].brand + '</h5>' +
			'<p>' + products[i].product_name + '</p>' +
			'<p>$' + products[i].price + '</p>' +
			'<button type="submit" onclick="addToCart(\'id_' + (i + 1) + '\', \'' + products[i].img_src + '\', \'' + products[i].brand + ' ' + products[i].product_name + '\', \'' + products[i].price + '\', \'70\')" class="btn_cart">' +
			  '<ion-icon class="cart_icon" name="cart-outline"></ion-icon>' +
			'</button>' +
		  '</div>' +
		'</div>' +
	  '</div>';
	}
	document.querySelector('#recommendation-container').innerHTML = productList;
  
  }
});	
	
}
