<?php
session_start();

//Include libraries
require __DIR__.'/vendor/autoload.php';


function addProducts(){

    // Connect to mongo client
    $mongoClient = (new MongoDB\Client);

    //select database
    $db = $mongoClient->ecommerce;

    // select database collection
    $collection = $db->products;


    // filter and sanitize user input data submitted through an HTTP POST request in the add function
    $name= filter_input(INPUT_POST, 'name', FILTER_SANITIZE_STRING);
    $brand= filter_input(INPUT_POST, 'brand', FILTER_SANITIZE_STRING);
    $description= filter_input(INPUT_POST, 'description', FILTER_SANITIZE_STRING);
    $price= filter_input(INPUT_POST, 'price', FILTER_SANITIZE_STRING);
    $stock= filter_input(INPUT_POST, 'quantity', FILTER_SANITIZE_STRING);
    $img= filter_input(INPUT_POST, 'image', FILTER_SANITIZE_STRING);

//    Send the data into an array to be then inserted into the databse
    $dataArray = [
        "name" => $name,
        "brand" => $brand,
        "description"=> $description,
        "imagePath"=> $img,
        "price" => $price,
        "stock" => $stock
    ];
    $insertResult = $collection->insertOne($dataArray);

}

function deleteProducts(){

//    connect to database
    $mongoClient = (new MongoDB\Client);
    $db = $mongoClient->ecommerce;

//    filter and sanitze user input sent from the delete function
    $pID = filter_input(INPUT_POST, 'id', FILTER_SANITIZE_STRING);

//    use id sent to find specific product containing the ID
    $deleteCriteria = [
        "_id" => new MongoDB\BSON\ObjectID($pID)
    ];

    $deleteRes = $db->products->deleteOne($deleteCriteria);

//    Send appropriate messages
    if($deleteRes->getDeletedCount() == 1){
        echo 'Customer deleted successfully.';
    }
    else{
        echo 'Error deleting customer';
    }
}

function deleteOrders(){

    // Connect to Database
    $mongoClient = (new MongoDB\Client);
    $db = $mongoClient->ecommerce;

    $pID= filter_input(INPUT_POST, 'id', FILTER_SANITIZE_STRING);


//    Use id to find order
    $deleteCriteria = [
        "_id" => new MongoDB\BSON\ObjectID($pID)
    ];

//    delete order
    $deleteRes = $db->orders->deleteOne($deleteCriteria);

    if($deleteRes->getDeletedCount() == 1){
        echo 'Order deleted successfully.';
    }
    else{
        echo 'Error deleting order';
    }
}

function editProducts() {
    $mongoClient = new MongoDB\Client;
    $db = $mongoClient->ecommerce;
    $collection = $db->products;


//    filter and sanitize input from edit function
    $pID= filter_input(INPUT_POST, 'prod_id', FILTER_SANITIZE_STRING);
    $name= filter_input(INPUT_POST, 'prod_name', FILTER_SANITIZE_STRING);
    $brand= filter_input(INPUT_POST, 'prod_brand', FILTER_SANITIZE_STRING);
    $description= filter_input(INPUT_POST, 'prod_description', FILTER_SANITIZE_STRING);
    $price= filter_input(INPUT_POST, 'prod_price', FILTER_SANITIZE_STRING);
    $stock= filter_input(INPUT_POST, 'prod_quantity', FILTER_SANITIZE_STRING);
    $img= filter_input(INPUT_POST, 'prod_Image', FILTER_SANITIZE_STRING);

    // create array to hold information to be changed
    $dataArray = [];


//    if no input was found (if no input was given in the form) do not add to array to be sent to database
//    This stops the database from overwriting data in the database with empty content
    if (!empty($name)){
        $dataArray['name'] = $name;
    }
    if (!empty($brand)){
        $dataArray['brand'] = $brand;
    }
    if (!empty($description)){
        $dataArray['description'] = $description;
    }
    if (!empty($price)){
        $dataArray['price'] = $price;
    }
    if (!empty($stock)){
        $dataArray['stock'] = $stock;
    }


    // update Database
    $updateResult = $collection->updateOne(
        ['_id' => new MongoDB\BSON\ObjectID($pID)],
        ['$set' => $dataArray]
    );

    if ($updateResult->getModifiedCount() > 0) {
        echo true;
    } else {
        echo false;
    }
}


// Check if a POST request has been sent with a key "server_Function"
if(isset($_POST['server_Function'])) {
    // Get the value of "server_Function"
    $call_Function = $_POST['server_Function'];

//    CALL APPROPRIATE FUNCTIONS
    if($call_Function == 'addProducts') {
        addProducts();
    }
    else if($call_Function == 'deleteProducts') {
        deleteProducts();
    }
    else if($call_Function == 'editProducts') {
        editProducts();
    }
    else if($call_Function == 'deleteOrders') {
        deleteOrders();
    }
}

function displayTotalProducts(){
    $mongoClient = new MongoDB\Client;
    $db = $mongoClient->ecommerce;
    $collection = $db->products;

// get the total count of documents in the collection
    $totalCount = $collection->countDocuments();

// output the count as plain text
    echo $totalCount;
}

function displayTotalOrders(){
    $mongoClient = new MongoDB\Client;
    $db = $mongoClient->ecommerce;
    $collection = $db->orders;

// get the total count of documents in the collection
    $totalCount = $collection->countDocuments();

// output the count as plain text
    echo $totalCount;
}

 function displayTotalStaff(): void {
    $mongoClient = new MongoDB\Client;
    $db = $mongoClient->ecommerce;
    $collection = $db->staff;

// get the total count of documents in the collection
    $totalCount = $collection->countDocuments();

// output the count as plain text
    echo $totalCount;
}

//UPLOAD AN IMAGE
if(!isset($_FILES["imageToUpload"]) || $_FILES["imageToUpload"]["name"] == "" || $_FILES["imageToUpload"]["name"] == null){
    return false;
}

// Check if file is a valid image
if(getimagesize($_FILES["imageToUpload"]["tmp_name"]) === false) {
    return false;
}

// Check that the file is the correct type
$valid_extensions = array("jpg", "png", "webp", "jpeg", "gif");
$imageFileType = pathinfo($_FILES["imageToUpload"]["name"], PATHINFO_EXTENSION);

if(!in_array($imageFileType, $valid_extensions)) {
    return false;
}

//Specify where file will be stored
$target_file = '../assets/NewImages/' . $_FILES["imageToUpload"]["name"];


