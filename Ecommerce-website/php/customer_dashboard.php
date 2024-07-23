<?php
$pageTitle = "Dashboard";
//Include the PHP functions to be used on the page
include('common.php');
include('customer_cart.php');

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
<!--SIDE NAVIGATION BAR -->
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

<!-- PROFILE VIEW AND EDIT CONTAINER -->
<div class="container" id="profile-container">
    <div class="login-form">
        <form id="customer_profile">
            <h1>Customer Details</h1> 

            <label for="Name">Name</label>
            <input type="text" placeholder=" Name" name="name" id="name" required />

            <label for="em">Address</label>
            <input type="text" placeholder=" Address" name="address" id="address" required />

            <label for="Telephone Number">Telephone Number</label>
            <input type="text" placeholder=" Telephone Number" pattern="[0-9]{8}" name="number" id="number" required />

            <label for="email">Email</label>
            <input type="text" placeholder=" Email" name="email" id="email" required />

            <label for="psw">Password</label>
            <input type="password" placeholder=" Password" name="psw" id="password" required />

            <label for="psw-repeat">Confirm Password</label>
            <input type="password" placeholder="Confirm Password" name="psw-repeat" id="password-repeat" required /> 

            <div class="buttons">
                <button type="button" class="cancel-button" id="edit-btn">Edit</button>
                <button type="submit" class="signupbtn" >Save</button>
            </div>
        </form>
    </div>
</div>
<script type="text/javascript" src="../javascript/customer_dashboard.js"></script>

</body>
</html>

<script>

    function logout(){
        localStorage.clear();
        sessionStorage.clear();
        document.location.href = 'login.php';
    }


</script>