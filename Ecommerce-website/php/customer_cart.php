<?php
//include libraries
require __DIR__.'/vendor/autoload.php';

//create instance of the mongodb client
$mongoClient = (new MongoDB\Client("mongodb://localhost:27017"));


// This function adds the contents of the cart to the orders collection in the ecommerce database.
function addOrders(){
    // Connect to the ecommerce database and select the orders' collection.
    $mongoClient = (new MongoDB\Client);
    $db = $mongoClient->ecommerce;
    $collection = $db->orders;

    // Retrieve the cart information from the POST data.
    $cart = json_decode(filter_input(INPUT_POST, 'cartInfo'), true);

    // Construct an array containing the cart information to insert into the database.
    $dataArray = [
        "Cart" => $cart,
    ];

    // Insert the data array into the orders' collection.
    $collection->insertOne($dataArray);
}

// Check if the functionName parameter is set in the POST data.
if(isset($_POST['functionName'])) {
    $functionName = $_POST['functionName'];

    // If the functionName is 'addOrders', call the addOrders function.
    if ($functionName == 'addOrders') {
        addOrders();
    }
}

?>
<?php
function displayProducts(){

    // Establish a connection to the local MongoDB instance
    $mongoClient = (new MongoDB\Client("mongodb://localhost:27017"));

    // Select the 'ecommerce' database and the 'products' collection
    $db = $mongoClient->ecommerce->products;

    // Retrieve all documents from the 'products' collection
    $cursor = $db->find();

    // Loop through each document and display its contents
    foreach ($cursor as $document) {
        ?>
        <li>
            <div id="product-Image" class="product-Image">
                <!-- Display the product image -->
                <img src="<?php echo $document['imagePath']; ?>" style="width: 50%;" alt="Product Image">
            </div>

            <div>
                <div id="product-Brand"><h5><?php echo $document['brand']; ?></h5></div>
                <div id="product-Name"><p><?php echo $document['name']; ?></p></div>
                <div id="product-Price"><p>£<?php echo $document['price']; ?></p></div>

                <!-- Add a button to add the product to the cart -->
                <button id="add_btn" type="submit" onclick='addToCart(
                        "<?php echo $document['_id']; ?>",
                        retrieveUser(),
                        "<?php echo $document['imagePath']; ?>",
                        "<?php echo $document['brand']; ?>",
                        "<?php echo $document['price']; ?>",
                        "<?php echo $document['stock']; ?>")' class="btn_cart">
                    ADD TO CART
                </button>
            </div>
        </li>
        <?php
    }
}

?>

<script>
    function retrieveUser(){
        return localStorage.getItem('LoggedInUser');
    }
</script>
