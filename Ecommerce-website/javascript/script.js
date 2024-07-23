// Clears the cart by sending the contents of the cart to the server and then clearing the session storage.
function clearCart(){
    // Retrieve the cart from session storage.
    let cart = JSON.parse(sessionStorage.getItem('cart'));

    // Create an array to hold the order information.
    let carOrderInfo = [];

    // Loop through the cart and add the contents to the order information array.
    for (let i = 0; i < cart.length; i++){
        carOrderInfo.push(cart[i]);
    }

    // Send the order information to the server using an AJAX call.
    $.ajax({
        url: 'customer_order.php',
        type: 'POST',
        data: {
            cartInfo: JSON.stringify(carOrderInfo),
            functionName: "addOrders",
        },

        // Handle a successful response from the server.
        success: function () {
            console.log('Cart saved successfully');
        },

        // Handle an error response from the server.
        error: function (xhr, status, error) {
            console.log('Error saving cart: ' + error);
        }
    });

    // Clear the session storage.
    sessionStorage.clear();

    // Redirect the user to the home page.
    window.location.href='../php/home.php';
}


// Function to hide order table if no one is signed
function displayOrders() {
    console.log('displayOrders function called');
    document.getElementById('pastOrders').style.display = 'none';
}
if( localStorage.length < 1 ){
    displayOrders();
}
