<body>

<!--SIDE NAVIGATION BAR -->
<nav class="sidebar close">
    <?php
        include ("cmsCommon.php");
        include ("functions.php");
        head();
    ?>
</nav>

<!--DIV CONTAINER FOR ERROR MESSAGES-->
<div class="messages"></div>

<div class="mainContainer">

    <div class="pageNameContainer">

        <!--        HOME PAGE TITLE-->
        <i id="menuButton" class="ri-menu-unfold-line" style='font-size: 26px' ></i>
        <span class="pageTitle">Products</span>
    </div>

    <!--    Container for general content for the home page-->
    <div class="wrapper">

        <!--        Bottom layer of home page containing two boxes-->
        <ul class="bottomLayer">

            <!--            Second box containing order status of customers and date order was made-->
            <li id="productPage-Box" class="list" style="height:88vh">
                <h2 id="Order-title"><span>Products</span>

<!--                    BUTTON TO POP UP ADD MENU-->
                    <button class="action_btns" onclick="addMenu()">
                        <i class='bx bx-plus'></i>CREATE NEW
                    </button>


<!--                    BUTTON TO POP UP DELETE MENU-->
                    <button id="deleteBtn" class="action_btns" style="background: red"
                            onclick="deleteMenu()">
                        <i class='bx bx-trash'></i>Delete
                    </button>


 <!--                    BUTTON TO POP UP EDIT MENU-->
                    <button class="action_btns" onclick="inputEditId()">
                        <i class='bx bx-edit-alt' ></i>Edit
                    </button>
                </h2>

                <div class="TrackingBox">

                    <ul class="trackingTable">

                        <!--                        TABLE TITLES-->
                        <li class="table-header" style="color: #FFFFFF">
                            <div class="product_ID"><p style='font-size: 15px'>PRODUCT ID</p></div>
                            <div class="product_name"><p style='font-size: 15px'>PRODUCT NAME</p></div>
                            <div class="product_brand"><p style='font-size: 15px'>Brand</p></div>
                            <div class="product_Description"><p style='font-size: 15px'>Description</p></div>
                            <div class="product_Image"><p style='font-size: 15px'>Image Path</p></div>
                            <div class="product_Price"><p style='font-size: 15px'>Price</p></div>
                            <div class="product_stock"><p style='font-size: 15px'>Stock</p></div>

                        </li>

                        <?php
                        //include libraries
                        require __DIR__.'/vendor/autoload.php';

                        //create instance of the mongodb client
                        $mongoClient = (new MongoDB\Client("mongodb://localhost:27017"));

                        //select a database
                        $db = $mongoClient->ecommerce -> products;

                        // Find all documents in the collection
                        $cursor = $db->find();

//                        LOOP THROUGH ALL DOCUMENTS IN PRODUCT DATABASE
                        foreach ($cursor as $document) {
                            ?>

                            <!--                        PRODUCT DETAILS-->
                            <li class="table-row">
<!--                                DISPLAY PRODUCT DETIALS USING ECHO-->
                                <div id="id" class="product_ID"><?php echo $document['_id']; ?></div>
                                <div class="product_name"><?php echo $document['name']; ?></div>
                                <div class="product_brand"><?php echo $document['brand']; ?></div>
                                <div class="product_Description"> <?php echo $document['description'];?> </div>
                                <div class="product_Image"><img id="imagePreview" src="<?php echo $document['imagePath']; ?>" style="width: 90px;" alt="Product Image"></div>
                                <div class="product_Price"><?php echo $document['price']; ?></div>
                                <div class="product_stock"><?php echo $document['stock']; ?></div>
                            </li>
                            <?php
                        }
                        ?>
                    </ul>
                </div>
            </li>
        </ul>
    </div>
</div>

<!--Pop up to add products to database-->
<div class="popup" id="popup-1">
    <div class="content">
        <h2>Add Product</h2>

        <form>
            <!--                       Input field for product name-->
            <label>
                <input name="name" id='product-name' placeholder="Product Name*" value="<?php echo $_POST['pName'] ?? '' ?>"/>
            </label>
            <!--                        Input field for product price-->
            <label>
                <input type="number" name="price" id='product-price'  class='product-price-Brand' placeholder="Product Price*"/>
            </label>

            <!--                        Input field for product brand-->
            <label>
                <input name="brand" id='product-brand'  class='product-price-Brand' placeholder="Product Brand*"/>
            </label>

            <!--                        Input field for product stock quantity-->
            <label>
                <input type="number" name="quantity" id='product-quantity'  class='product-price-Brand' placeholder="Product Quantity*"/>
            </label>

            <!--                        Input field for product description-->
            <label>
                <textarea name="description" id='product-description' placeholder="Product Description"></textarea>
            </label>

            <!--                        Input field for product img -->
            <label>
                <input name="image" id='product-img'  class='product-image' value="<?php global $target_file; echo $target_file?> " disabled/>
            </label>

            <button type="submit" class="cancel-btn" onclick="addProduct()">Create</button>
            <button class="cancel-btn" onclick="addMenu()">Cancel</button>
        </form>

<!--        FORM TO UPLOAD IMAGE-->
        <form id="imgForm" method="post" enctype="multipart/form-data">
            <input  id='product-img' type="file" name="imageToUpload" >
            <input  type="submit" value="Upload Image" name="submit">
        </form>


    </div>
</div>

<!--POPUP TO EDIT PRODUCTS DATABSE-->
<div class="popup" id="popup-4">
    <div class="content">
        <h2>Edit Product</h2>

        <form>
            <!--                       Input field for product name-->
            <label>
                <input name="name" id='p-name' placeholder="Product Name*" value="<?php echo $_POST['pName'] ?? '' ?>"/>
            </label>
            <!--                        Input field for product price-->
            <label>
                <input type="number" name="price" id='p-price'  class='product-price-Brand' placeholder="Product Price*"/>
            </label>

            <!--                        Input field for product brand-->
            <label>
                <input name="brand" id='p-brand'  class='product-price-Brand' placeholder="Product Brand*"/>
            </label>

            <!--                        Input field for product stock quantity-->
            <label>
                <input type="number" name="quantity" id='p-quantity'  class='product-price-Brand' placeholder="Product Quantity*"/>
            </label>
            <!--                        Input field for product description-->
            <label>
                <textarea name="description" id='p-description' placeholder="Product Description"></textarea>
            </label>

            <button class="cancel-btn" onclick="editProduct()">Update</button>
            <button class="cancel-btn" onclick="editMenu()">Cancel</button>
        </form>
    </div>
</div>


<!--DELETE MENU POPUP-->
<div class="delpop" id="popup-2">
    <div class="delpopcont">
        <form>
            <label>
                <input name="id" id='pr-id' class='edit-delete_Input' placeholder="Product ID*"/>
                <button style="background: #dc1515; color: #FFFFFF;" class="cancel-btn" type="submit" onclick="deleteProduct()">delete</button>
                <button class="cancel-btn" onclick="deleteMenu()">Cancel</button>
            </label>
        </form>
    </div>
</div>


<!--INPUT ID TO EDIT PRODUCTS POPUP-->
<div class="delpop" id="popup-3">
    <div class="delpopcont">
            <label>
                <input name="id" id='p-id' class='edit-delete_Input' placeholder="Product ID*"/>
                <button style="background: #dc1515; color: #FFFFFF;" class="cancel-btn" type="submit" onclick="editMenu()">Edit</button>
                <button class="cancel-btn" onclick="inputEditId()">Cancel</button>
            </label>
    </div>
</div>



<script src="../JS/script.js"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</body>
