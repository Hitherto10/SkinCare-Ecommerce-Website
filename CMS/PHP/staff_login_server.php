<?php

require __DIR__.'/vendor/autoload.php';

//start session
session_start();

//connect to mongodb client
$mongoClient = new MongoDB\Client;
$db = $mongoClient->ecommerce;
$collection = $db->staff;

//filter and sanitize input from login form
$staff_username = filter_input(INPUT_POST, 'username', FILTER_SANITIZE_STRING);
$staff_password = filter_input(INPUT_POST, 'password', FILTER_SANITIZE_STRING);


//create a PHP array with username and password
$findCriteria = [
    'username' => $staff_username,
    'password' => $staff_password
];

//match items in the find criteria with documents in the database
$count = $collection->countDocuments($findCriteria);


//if no document is found, inform the user
if ($count == 0) {
    echo json_encode(array(
        'success' => false
    ));

}

//if document is found, echo an array which contains the success message and current logged in user back
else {
    $_SESSION["loggedInUser"] = $staff_username;
    echo json_encode(array(
        'success' => true,
        'loggedInUser' => $_SESSION["loggedInUser"]
    ));
}
