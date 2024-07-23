<body>

<!--SIDE NAVIGATION BAR -->
<nav id="main-nav" class="sidebar close">

    <?php
        include ("cmsCommon.php");
        include ("functions.php");
        head();
    ?>

</nav>

<!--DIV TO DISPLAY ERROR MESSAGES-->
<div class="messages"></div>

<!--HOME PAGE CONTENTS-->
<div class="mainContainer">
    <div class="pageNameContainer">

        <!--        HOME PAGE TITLE-->
        <i id="menuButton" class="ri-menu-unfold-line" style='font-size: 26px' ></i>
        <span class="pageTitle">Home</span>
    </div>

    <!--    Container for general content for the home page-->
    <div class="wrapper">

        <!--        Top layer of home page containing three boxes-->
        <ul class="topLayer">

            <!--            Box indicating total number of orders completed-->
            <li>
                <img class="statimg" style='font-size: 55px' alt="" src="../assets/shopping-bag.png">

<!--                CALL FUNCTION TO DISPLAY TOTAL ORDERS-->
                <span><h1><?php echo displayTotalOrders() ?></h1><p>Total Orders</p></span>
            </li>


            <!--            Box indicating total number of products in database-->
            <li>
                <img class="statimg" style='font-size: 55px' alt="" src="../assets/received.png">

<!--                CALL FUNCTION TO DISPLAY TOTAL ORDERS-->
                <span><h1 id="totalOrders"> <?php echo displayTotalProducts() ?> </h1><p>Total Products</p></span>
            </li>

            <!--            total number of users that have visited the page-->
            <li>
                <img class="statimg" style='font-size: 55px' alt="" src="../assets/man.png">

<!--                CALL FUNCTION TO DISPLAY TOTAL STAFF AVAILABLE-->
                <span><h1><?php echo displayTotalStaff() ?></h1><p>Staff Available</p></span>
            </li>
        </ul>

        <!--        Bottom layer of home page containing two boxes-->
        <ul class="bottomLayer">

            <!--            Second box containing order status of customers and date order was made-->
            <li id="productPage-Box" class="list" style="height:75vh">
                <h2 id="Order-title"><span>Customer Orders</span>

<!--                    BUTTON TO POP UP DELETE MENU-->
                    <button id="deleteBtn" class="action_btns" style="background: red"
                            onclick="deleteMenu()">
                        <i class='bx bx-trash'></i>  Delete
                    </button>

                </h2>

                <div class="TrackingBox">

                    <ul class="trackingTable">

                        <!--                        TABLE TITLES-->
                        <li  class="table-header" style="color: #FFFFFF">
                            <div class="custName"><p>Customer Name</p></div>
                            <div class="orderImage headerBrand"><p>Order Brand</p></div>
                            <div class="orderPrice"><p>Order Price</p></div>
                            <div class="orderQuantity"><p>Order Quantity</p></div>
                            <div class="stockLeft"><p>Stock Left</p></div>

                        </li>
                        <?php

                            require __DIR__.'/vendor/autoload.php';
                            // Connect to MongoDB
                            $mongoClient = (new MongoDB\Client);

                            //select a database
                            $db = $mongoClient->ecommerce;
                            $collection = $db->orders;

                            //  Retrieve all documents
                            $filter = [];
                            $options = [];
                            $query = new MongoDB\Driver\Query($filter, $options);

                            $manager = new MongoDB\Driver\Manager('mongodb://localhost:27017');
                            $documents = $manager->executeQuery($collection, $query);

//                            loop through documents found in query
                            foreach ($documents as $document) {
                                $cart = $document->Cart;
                        ?>

<!--                                    DISPLAY ID PER CART ORDER-->
                            <div class="Order-Format_ID"> <?php echo "<span>Order ID:</span> {$document->_id->__toString()}:"; ?> </div>

                        <?php
//                                LOOP THROUGH CART TO GET EVERY ITEM ORDERED
                            foreach ($cart as $item) {
                        ?>

                        <li class="table-row">
<!--                            DISPLAY ITEMS IN CART WITHIN FOR LOOP-->
                            <div class="custName orderRec"><?php  echo "{$item->model}"; ?></div>
                            <div class="orderImage orderRec"><img style="width: 90px;" src='<?php  echo "{$item->img}"; ?>'  alt="Product Image"></div>
                            <div class="orderBrand orderRec"> <?php  echo "{$item->model}"; ?> </div>
                            <div class="orderPrice orderRec"> <?php  echo "{$item->price}"; ?> </div>
                            <div class="orderQuantity orderRec"> <?php echo "{$item->quantity}"; ?> </div>
                            <div class="stockLeft orderRec"> <?php  echo "{$item->stock}"; ?> </div>
                        </li>
                        <?php
                            }
                        }
                        ?>
                    </ul>
                </div>
            </li>
        </ul>

    </div>
</div>

<!--DELETE POPUP DIV-->
<div class="delpop" id="popup-2">
    <div class="delpopcont">
        <form>
            <label>
                <input name="id" id='order-id' placeholder="Product ID*"/>
                <button style="background: #dc1515; color: #FFFFFF;" class="cancel-btn" type="submit" onclick="deleteOrder()">delete</button>
                <button class="cancel-btn" onclick="deleteMenu()">Cancel</button>
            </label>
        </form>
    </div>
</div>


<script src="../JS/script.js"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</body>
