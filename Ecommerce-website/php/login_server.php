<?php
// start session management
session_start();

// include database
require __DIR__.'/vendor/autoload.php';

$mongoClient = (new MongoDB\Client);

$db = $mongoClient->ecommerce;

// status key is used for reponse status while message key is use to display error or success messages
$response = array(
    'status' => 0,
    'message' => 'Form submission failed',

);

// variables
$errorEmpty = false;
$errorEmail = false;

// verify if form input is set
if (isset($_POST['email']) && isset($_POST['psw'])) {
    // need to filter input to reduce chances of SQL injection etc.
    $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_STRING);
    $password = filter_input(INPUT_POST, 'psw', FILTER_SANITIZE_STRING);

    $response['loggedInUser'] =  $email;

    // create a PHP array with the search criteria
    $findCriteria = [
    "email" => $email,
    "password" => $password
    ];

    // connect to customer collection
    $collection = $db->customers;

    $count = $collection->countDocuments($findCriteria);

    // verify if email and password fields are empty
    if (($email != "" && $password != "" )) {
        // checks if data present in database
        if ($count == 1) {
            $response['message'] = "Logged in successfully!";
            $response['status'] = 1;

            // stores email in session
            $_SESSION['loggedinUser'] = $email;
           
        } else {
            $response['message'] = "Incorrect email or password.";
        } 
    } else {
        $response['message'] = "*Fill in empty fields";
        $errorEmpty = true; 
        }
    }

// encode variable 'response' to json format
echo json_encode($response);
?>
