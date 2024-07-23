<?php
    $pageTitle = "Home";
    //Include the PHP functions to be used on the page 
    include('common.php'); 
    include('customer_cart.php');
    include ('front.php');

    //Output header and navigation 
    output_title($pageTitle);
    outputNavigation($pageTitle);
?>


<section class="products" id="products">

    <!-- products section starts  -->
    <h1 class="heading">
        <span>Products</span>
    </h1>

    <!-- products section header  -->

</section>


<!-- contact section ends -->

<section class="contact" id="contact">
    <!-- contact section starts  -->
    <h1 class="heading">
        <span> Contact Us </span>
    </h1>

    <!-- Contact us header -->
    <div class="row">

        <!-- Div wrapper container -->
        <form action="">
            <!--Form container with name, email, and number input -->
            <input type="text" placeholder="name" class="box">
            <input type="email" placeholder="email" class="box">
            <input type="number" placeholder="number" class="box">
            <textarea name="" class="box" placeholder="message" id="" cols="30" rows="10"></textarea>
            <input type="submit" value="send message" class="btn">
        </form>

        <div class="image">
            <img src="../assets/44.png" alt="">
            <!-- contact us section background image -->
        </div>
    </div>
</section>


<?php
// include footer.php file
include ('footer.php');
?>


<script type="text/javascript" src="../javascript/add_to_cart.js"></script>

