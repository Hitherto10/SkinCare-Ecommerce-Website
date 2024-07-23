<?php
$pageTitle = "Orders";
//Include the PHP functions to be used on the page
include('common.php');
include('customer_cart.php');
include('login_server.php');


//Output header and navigation
output_title($pageTitle);
outputNavigation($pageTitle);
?>
    <!DOCTYPE html>
    <html lang="en">
    <head>
        <!--    HEADER TITLE AND LINKS-->
        <meta charset="UTF-8">
        <title> Content Management System</title>
        <link rel="stylesheet" href="../css/dashboard.css">
        <link href='https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css' rel='stylesheet'>
        <link href="https://cdn.jsdelivr.net/npm/remixicon@2.5.0/fonts/remixicon.css" rel="stylesheet">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
    </head>
    <body>
    SIDE NAVIGATION BAR
    <nav class="sidebar close">

        <!--    navigation links for various pages-->
        <ul class="nav-links" id="navigation">

            <!--        PROFILE PAGE-->
            <li>
                <a href="customer_dashboard.php">
                    <i class='bx bx-user-pin' style='color:#ffffff; font-size: 26px'  ></i>
                    <span class="link_name">Profile</span>
                </a>
            </li>


            <!--        CUSTOMER ORDER PAGE-->
            <li>
                <div class="icon-link">
                    <a href="customer_order.php">
                        <i class='bx bxs-shopping-bag' style='color:#ffffff'></i>
                        <span class="link_name">Previous Orders</span>
                    </a>
                    <i class='bx bxs-chevron-down arrow' ></i>
                </div>
            </li>

            <!--        LOGOUT BUTTON-->
            <li>
                <div class="logoutContainer">
                    <div class="logoutButton"></div>
                    <div class="container"></div>
                    <div class="btn-text">
                        <a onclick="logout()">
                            <div class="signoutButton"><span>Logout</span><i class='bx bx-log-out' style='font-size: 26px; color:#e00707'></i>
                            </div>
                        </a>

                    </div>
                </div>

            </li>
        </ul>
    </nav>


    <?php
    // Require the autoloader file to load the MongoDB PHP Library
    require __DIR__.'/vendor/autoload.php';

    // Connection URI and database name
    $uri = "mongodb://localhost:27017";
    $dbName = "ecommerce";

    // Connect to MongoDB
    $client = new MongoDB\Client($uri);

    // Select the 'orders' collection in the specified database
    $collection = $client->$dbName->orders;

    // Find all carts for the specified email (stored in a session variable)
    $carts = $collection->find(["Cart.customer" => $_SESSION['loggedinUser'] ]);

    ?>
    <!-- Generate the HTML table to display past orders -->
    <div id="pastOrders" class="orders-container">
        <div id="orders-header" class="orders-header">
            <ul>
                <li>Customer</li>
                <li>Model</li>
                <li>Price</li>
                <li>Quantity</li>
                <li>Stock</li>
            </ul>
        </div>
        <div class="orders-body">
            <?php
            // Loop through each cart and each item in the cart to generate a row in the table for each item
            foreach ($carts as $cart) {
                foreach ($cart->Cart as $item) {
                    ?>
                    <div class="order-row">
                        <ul>
                            <li><?php echo $item->customer ?></li>
                            <li><?php echo $item->model ?></li>
                            <li><?php echo $item->price ?></li>
                            <li><?php echo $item->quantity ?></li>
                            <li><?php echo $item->stock ?></li>
                        </ul>
                    </div>
                    <?php
                }
            }
            ?>
        </div>
    </div>


<script src="../javascript/script.js"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</body>
</html>

<script>

    function logout(){
        localStorage.clear();
        sessionStorage.clear();
        document.location.href = 'login.php';
    }


</script>

