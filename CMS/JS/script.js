// Add Event listener to toggle between showing the arrow and hiding it
const toggleArrow = (e) => {
    const arrowParent = e.currentTarget.parentElement.parentElement;
    arrowParent.classList.toggle("showMenu");
}


document.querySelectorAll(".arrow").forEach(arrow => {
    arrow.addEventListener("click", toggleArrow);
});


// Add event lister to close and open the sidebar menu when element with class 'sidebar' is clicked
const toggleSidebar = () => {
    document.querySelector(".sidebar").classList.toggle("close");
}


//toggle the "ri-menu-fold-line" and "ri-menu-unfold-line" classes for the element with id "menuButton"
document.querySelector(".ri-menu-unfold-line").addEventListener("click", toggleSidebar);
// each time button is clicked, the representing icon changes as well
const toggleMenuButton = () => {
    const icon = document.getElementById("menuButton");
    icon.classList.toggle("ri-menu-fold-line");
    icon.classList.toggle("ri-menu-unfold-line");
}
document.getElementById("menuButton").addEventListener("click", toggleMenuButton);



// Function to pop up the add product form when button is clicked
function addMenu() {

    // retrieve username from session storage
    const username = sessionStorage.getItem('LoggedInUser');


    /*
        Checks if a staff is logged in (username == null),
        if not alerts the user to log in before accessing menu
    */

    if (username != null){
        if (window.location.pathname.endsWith('/products.php')){

            // toggle the add product form when button clicked
            document.getElementById("popup-1").classList.toggle("active");
        } else {

            // display appropriate error message
            displayMessage("Visit the 'Manage Product' Page to add products")
        }
    }
    else {
        displayMessage("Login to add Content")
    }

}


// Popup Menu that requests a product ID inorder to edit product
function inputEditId() {
    const username = sessionStorage.getItem('LoggedInUser');
    if (username != null){
        /*
                 Check if the current file is the product page:
                 if not raise exception,
                 if it is display the add product pop up form
             */
        if (window.location.pathname.endsWith('/products.php')){
            // toggle the add product form when button clicked
            document.getElementById("popup-3").classList.toggle("active");
        } else {
            displayMessage("Visit the 'Manage Product' Page to edit products")
        }
    }
    else {
        displayMessage("Login to edit Content")
    }
}


// Popup Menu to edit product
function editMenu() {

    // retrieve username from session storage
    const username = sessionStorage.getItem('LoggedInUser');

    /*
        Checks if a staff is logged in (username == null),
        if not alerts the user to log in before accessing menu
    */

    if (username != null){
        inputEditId();

        /*
             Check if the current file is the product page:
             if not raise exception,
             if it is display the add product pop up form
         */
        if (window.location.pathname.endsWith('/products.php')){
            // toggle the add product form when button clicked
            document.getElementById("popup-4").classList.toggle("active");
            document.getElementById("create_product").reset();
        } else {
            displayMessage("Visit the 'Manage Product' Page to edit products")
        }
    }
    else {
        displayMessage("Login to edit Content")
    }

}


// Popup Menu that requests a product ID inorder to delete product
function deleteMenu() {
    const username = sessionStorage.getItem('LoggedInUser');
    if (username != null){
        document.getElementById("popup-2").classList.toggle("active");
    }
    else {
        displayMessage("Login to Delete Content")
    }
}



function addProduct() {

    // Retrieve form inputs values from the add menu using jquery
    let productName = $('#product-name').val();
    let productPrice = $('#product-price').val();
    let productBrand = $('#product-brand').val();
    let productQuantity = $('#product-quantity').val();
    let productIMG = $('#product-img').val();
    let prodDescription = $('#product-description').val();


    // Ensure no input field is left empty and if so, alert the user
    if (productName === "" || productPrice === "" || productBrand === "" || productQuantity === "" || prodDescription === ""){
        alert('Fill all the Blanks before Creating');

    }

    else{
        // Make an AJAX request to the functions.php file
        $.ajax({
            url: "functions.php",
            type: "POST",

            // Send product details to server
            // Specify the data to send in the request
            data: {

                // Set the server function to call
                server_Function: "addProducts",
                name: productName,
                price: productPrice,
                brand: productBrand,
                quantity: productQuantity,
                image: productIMG,
                description: prodDescription,
            },

            // Display message upon successful request
            success: function() {
                alert("Product Added successfully!");
            }
        });
    }
}

function deleteProduct() {
    let productID = $('#pr-id').val();

    // If the ID field is empty, display error message
    if (productID === ""){
        alert("Input the ID Before Deleting");
    }

     // make an AJAX request to the server to delete the product with the given ID
    else{
        $.ajax({
            url: "functions.php",
            type: "POST",
            data: {
                server_Function: "deleteProducts",
                id: productID,
            },

            // When the request is successful, show a success message
            success: function() {
                alert("Product Removed successfully!");
            }
        });
    }
}

function deleteOrder() {
    // retrieve order input from form
    let orderID = $('#order-id').val();


    // If the ID field is empty, display error message
    if (orderID === ""){
        alert("Input the ID Before Deleting");
    }

    // send AJAX request to the server to delete the order with the given ID
    else{
        $.ajax({
            url: "functions.php",
            type: "POST",
            data: {
                server_Function: "deleteOrders",
                id: orderID,
            },
            success: function() {
                alert("Order Removed successfully!");
            }
        });
    }
}

function editProduct() {


    // retrieve product details from form using jquery
    let pId = $('#p-id').val();
    let pName = $('#p-name').val();
    let pPrice = $('#p-price').val();
    let pBrand = $('#p-brand').val();
    let pQuantity = $('#p-quantity').val();
    let pDescription = $('#p-description').val();

    // send request to server, and send product information
    $.ajax({
        url: "functions.php",
        type: "POST",
        data: {
            // call to server function
            server_Function: "editProducts",
            prod_id: pId,
            prod_name: pName,
            prod_price: pPrice,
            prod_brand: pBrand,
            prod_quantity: pQuantity,
            prod_description: pDescription,
        },

        success: function() {
            alert("Product updated successfully!");
        }
    });
}

function loginStaff() {
    let staff_username = $('#username').val();
    let staff_password = $('#password').val();

    $.ajax({
        url: "staff_login_server.php",
        type: "POST",
        data: {
            username: staff_username,
            password: staff_password,
        },

        // receive response from server
        success: function(response) {
            let data = JSON.parse(response); // response =(Username) sent back from server

            // inform user upon successful login
            if (data.success) {
                alert("Logged in successfully as " + data.loggedInUser);
                sessionStorage.setItem("LoggedInUser", data.loggedInUser);

                // change location after logging in
                document.location.href = 'home.php';
            } else {
                alert("Incorrect email or password.");
            }
        }
    });

}



function displayMessage(messageText) {
    let messages = document.getElementsByClassName("messages");
    for (let i = 0; i < messages.length; i++) {
        messages[i].innerHTML = messageText;
        messages[i].style.display = "block";
        fadeOut(messages[i]);
    }
}

// Fades the message in and out of the screen
function fadeOut(message) {
    setTimeout(function() {
        message.style.opacity = "1";
        message.style.transform = "translateX(0)";
        setTimeout(function() {
            message.style.opacity = "0";
            message.style.transform = "translateX(100%)";
        }, 3000);
    }, 100);
}

// shows total number of orders in the database
$.ajax({
    url: 'functions.php',
    type: 'GET',
    success: function(data) {
        $('#totalOrders').html(data);
    }
});


