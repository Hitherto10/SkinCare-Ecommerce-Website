window.addEventListener("load",loadCart);
let cart_table = document.getElementById("display_data");
let hidden_form = document.getElementById("checkout");
let subtotal_p = document.getElementById("subtotal_p");
let total_p = document.getElementById("total_p");
let subtotal = 0;
let total = 0;
data =[];
//Displays products in cart page.
function loadCart() {
    let prods = [];
    //retrieve data from local storage
    let cart = JSON.parse(sessionStorage.cart);
    //display data in table format
    for (let x = 0; x < cart.length; x++) {
        data += `
            <tr>
                <td><img width=100px height=auto src="${cart[x].img}"</td>
                <td>${cart[x].model}</td>
                <td>${cart[x].price}</td>
                <td>${cart[x].quantity}</td>
                <td>
                    <button onclick =deleteProduct("${cart[x].id}") class="remove_btn">
                        <img style="width: 25px" src="../assets/remove.png" alt="Remove Icon">
                    </button>
                </td>
            </tr>
        `;
        prods.push({id: cart[x].id, product_img:cart[x].img, quantity: cart[x].quantity, cost:(cart[x].price * cart[x].quantity), stock: cart[x].stock});


        subtotal += parseInt(cart[x].price * cart[x].quantity);

    }
    cart_table.innerHTML = data;
    subtotal_p.innerHTML = "£" + subtotal.toString();
    //calculate total cost of all product present in cart
    if (subtotal > 0) {
        total = subtotal;
        total_p.innerHTML = "£" + total.toString();
    }
    else{
       sessionStorage.clear();
    }

    //using form to send order details
    if (sessionStorage.getItem('cart') !== null && sessionStorage.getItem('cart').length > 0) {
        let htmlStr = "<form action='receipt.php' method='post'>";
        htmlStr += "<input type='hidden' name='prodIDs' value='" + JSON.stringify(prods) + "'>";
        htmlStr += "<input  type='submit' id='checkout_btn' value='Checkout'></form>";
        hidden_form.innerHTML = htmlStr;
        let orderData = JSON.parse(sessionStorage[1]);
    }

}
