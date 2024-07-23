<?php 
// start session management
session_start();

// checks if user is logged in
if(!isset($_SESSION['loggedinUser'])) {
    // redirects to login page
    header("Location: login.php");
}
    // include libraries
    require __DIR__ . '/vendor/autoload.php';

    // create instance of MongoDB client
    $mongoClient = (new MongoDB\Client);

    // select database
    $db = $mongoClient -> ecommerce;

    // select customers collection
    $collection = $db -> customers;

    // retrieve data from session and check in database
    $cursor = $collection->findOne(['email' => $_SESSION['loggedinUser']]);

    // if data found, retrieve values from cursor.Else,display error message
    if (!empty($cursor)) {
        $name = $cursor['name'];
        $address = $cursor['shipping address'];
        $number = $cursor['phone number'];
        $email = $cursor['email'];
        $password = $cursor['password'];
    } else {
        echo "Error: could not retrieve customer data from database.";
    }


