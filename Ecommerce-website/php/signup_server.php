<?php
require __DIR__.'/vendor/autoload.php';

$mongoClient = (new MongoDB\Client);

$db = $mongoClient->ecommerce;

// status key is used for reponse status and message key is use to display error or success messages
$response = array(
    'status' => 0,
    'message' => 'Form submission failed'
);

// variables
$errorEmpty = false;
$errorEmail = false;

// verify if form input is set
if (isset($_POST['name']) || isset($_POST['address']) || isset($_POST['number']) || isset($_POST['email']) || isset($_POST['psw']) || isset($_POST['psw-repeat'])) {
    // get form data and filtered to reduce chances of SQL injection 
    $name = filter_input(INPUT_POST, 'name', FILTER_SANITIZE_STRING);
    $address = filter_input(INPUT_POST, 'address', FILTER_SANITIZE_STRING);
    $number = filter_input(INPUT_POST, 'number', FILTER_SANITIZE_STRING);
    $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_STRING);
    $password = filter_input(INPUT_POST, 'psw', FILTER_SANITIZE_STRING);
    $confirm_password = filter_input(INPUT_POST, 'psw-repeat', FILTER_SANITIZE_STRING);

    // select customer collection
    $collection = $db->customers;

    // convert to PHP array
    $dataArray = [
        "name" => $name,
        "shipping address" => $address,
        "phone number" => $number,
        "email" => $email,
        "password" => $password,
    ];
    
    // data not stored in db if fields are empty 
    if (($name != "" && $address != "" && $number != "" && $email != "" && $password != "" && $confirm_password != "")) { 
        // validates email format
        if (!filter_var($email,FILTER_VALIDATE_EMAIL)) {
            $response['message'] ="*Invalid email address! \nEmail should be in the format example@mail.com";
            $errorEmail=true;
        } 
        else if ($password != $confirm_password) {
            $response['message'] = "*Password and confirm password should be the same.";
        } 
        // checks if email already exists
        else if ($collection->countDocuments(["email" => $email]) > 0) {
            $response['message'] = "*Email already exists";
            $errorEmail = true;
        }
        else {
            if ($errorEmpty == false && $errorEmail == false) {
                // insert data in customer collection
                $insertResult = $collection->insertOne($dataArray);
                $response['message'] = "Registered successfully!";
                $response['status'] = 1;
            }
        }    
    }
    else {
        $response['message'] = "*Fill in the missing fields!";
        $errorEmpty = true;
    }            
} 
 

// encode variable 'response' to json format
echo json_encode(($response));

?>






