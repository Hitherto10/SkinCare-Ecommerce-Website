<?php
$pageTitle = "Cart";

//Include the PHP functions to be used on the page 
include('common.php'); 

    //Output header and navigation 
    output_title($pageTitle);
    outputNavigation($pageTitle);
?>

    <h2>CART</h2>
    <!-- Table to display cart -->
    <div class="cart_table">
    <table>
        <thead>
            <tr>
                <th>Picture</th>
                <th>Model</th>
                <th>Price</th>
                <th>Quantity</th>
                <th>Remove</th>
            </tr>   
        </thead>
        <tbody id="display_data">

        </tbody>
    </table>
    </div>

    <!-- Table to display total cost -->
    <div class="total_table">
        <table>
            <tr>
                <td>Subtotal</td>
                <td id="subtotal_p"></td>
            </tr>
            <tr>
               
            </tr>
            <tr>
                <td>Total</td>
                <td id="total_p"></td>
            </tr>
        </table>
        <div id="checkout"></div>
    </div>

<script type="text/javascript" src="../javascript/add_to_cart.js"></script>
<script type="text/javascript" src="../javascript/loadCart.js"></script>
<script type="text/javascript" src="../javascript/script.js"></script>
