window.addEventListener("load",Cartcount);
//function to count number of items in cart then display
function Cartcount(){
    let total = 0;
    let count = document.getElementById("cart_count");
    let cart = JSON.parse(sessionStorage.cart);
    if(cart.length === 0){
        count.innerHTML = 0;
    }
    else{
        for (let i = 0; i < cart.length; i++) {
            total += cart[i].quantity;
        }
        count.innerHTML = total;
    }
    
}