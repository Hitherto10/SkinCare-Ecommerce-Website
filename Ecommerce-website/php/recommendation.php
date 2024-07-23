<?php

//Include libraries
require '../../vendor/autoload.php';

//Create instance of MongoDB client
$mongoClient = (new MongoDB\Client);

//Select a database
$db = $mongoClient->ecommerce;

// Check if the user has an active session
if (isset($_SESSION['loggedInUser'])) {
    $user_email = ($_SESSION['loggedInUser']);
    $findCriteria = ["Customer_email" => $user_email];

    //retrive orders for current logged in customer
    $cursor = $db->orders->find($findCriteria);
    $brands = [];
    $arr = [];
    //retrive all product brands that the customer has bought
    foreach ($cursor as $document){
        $product = $document['product'];
        $cursor2 = $db->products->find(['_id' => new MongoDB\BSON\ObjectId("$product")])->toArray();
        foreach ($cursor2 as $document2){
            array_push($brands,$document2['brand']);
        }
    }
    
    //retrieve all products having the brand name present in array brands[]
    $query = array('brand' => array('$in' => $brands));
    $results = $db->products->find($query);
} else {
    $results = $db->products->find();
}

$json = '['; //Start of array of products in JSON

// Get the products that are in the user's cart
$cart_items = [];
if (isset($_SESSION['cart'])) {
    $cart_items = $_SESSION['cart'];
}

// Don't display products that are already in the cart
foreach ($results as $document) {
    if (!in_array($document['_id'], $cart_items)) {
        $json .= json_encode($document);
        $json .= ",";
    }
}

// Remove last comma
$json = substr($json, 0, strlen($json) - 1);

// Close array
$json .= ']';

// Echo final string
echo $json;

?>
