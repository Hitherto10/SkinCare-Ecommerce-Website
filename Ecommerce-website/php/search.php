<?php
$pageTitle = "Search Results";

// include the PHP functions to be used on the page 
include('common.php'); 

// output header and navigation 
output_title($pageTitle);
outputNavigation($pageTitle);
?>

<?php
// include libraries
require __DIR__ . '/vendor/autoload.php';

// create instance of MongoDB client
$mongoClient = (new MongoDB\Client);

// select database
$db = $mongoClient->ecommerce;

// need to filter input to reduce chances of SQL injection
$searchString= filter_input(INPUT_POST, 'search_query', FILTER_SANITIZE_STRING);

// connect to collection
$productCollection = $db->products;

// create a PHP array for searching criteria
$findCriteria =
    array('$text' => array('$search' => $searchString));

// executes finding products when search is not empty
if ($searchString != "null") {
    // find all the product that match the criteria
    $productCursor = $productCollection->find($findCriteria);

    if ($productCursor -> isDead()) {
        echo 'Error iterating through results!';
    }
    else {
            //output the results in an html table
            echo "<table id='search-table'>";
            echo "<thead>
            <tr>
            <th>ID</th>
            <th>Image</th>
            <th>
            <a href='#' style=color:#36AE7C onclick='sortTable(0)'>Name</a>
            </th>
            <th>Brand</th>
            <th>Description</th>
            <th>
            <a href='#'style=color:#36AE7C onclick='sortTable(1)'>Price</a>
            </th>
            <th>Stock</th>
            </tr>
            </thead>
            <tbody>";
            foreach ($productCursor as $prod) {
            echo "<tr>";
            echo "<td>" . $prod['_id'] . "</td>";
            echo "<td>
            <img src='" . $prod['imagePath'] . 
            "'width='90px'></td>";
            echo "<td>" . $prod['name'] . "</td>";
            echo "<td>" . $prod['brand'] . "</td>";
            
            echo "<td>" . $prod['description'] . "</td>";
            echo "<td>$" . $prod['price'] . "</td>";
            echo "<td>" . $prod['stock'] . "</td>";
            echo "</tr>";
            }
            echo "</tbody>
            </table>";  
    }
}

?>

