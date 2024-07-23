<?php
//Ouputs the header for the page and opening body tag
function output_title($title) {
    echo '<!DOCTYPE html>';
    echo '<html>';
    echo '<head>';
    echo '<title>' . $title . '</title>';
    echo '<link rel="stylesheet" type="text/css" href="../css/main.css">';
    echo '<script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>';
    echo '<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>';
    echo '<script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>';
    echo '<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>';
    echo '<script type="text/javascript" src="../javascript/cart_items.js"></script>';
    echo '<link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.0/css/line.css">';
    echo '</head>';
	echo '<body>';
}

// Ouputs the navigation bar
function outputNavigation($pageName){
    //Output first part of navigation
    echo '<header class="navigation">';
    echo "<div class=\"logo\" id=\"wt_logo\">L'INTERDIT</div>";
    echo'<div class="all" id=\"wt_nav\">';
   
     //Array of pages to link to
     $linkNames = array("Home","Sign-in","About","Products", "Contact",
         "<ion-icon class='c_icon' name='cart-outline'></ion-icon><span id='cart_count'></span>",
         "<ion-icon class='c_icon' id='personIcon' name='person-outline'></ion-icon>");
    $linkAddresses = array("home.php","login.php","http://localhost/FinalSubmission/ecommerce/Website/website/php/#about", "http://localhost/FinalSubmission/ecommerce/Website/website/php/#products", "http://localhost/FinalSubmission/ecommerce/Website/website/php/home.php#contact", "cart.php", "customer_dashboard.php");


    echo'<ol>';
    $i = 0;
     // Using a while loop to output navigation
    while($i < count($linkNames)){
        echo '<li><a href="' . $linkAddresses[$i] . '">' . $linkNames[$i] . '</a></li>';
        $i++;
    }
    echo'</ol>';
   
   //output search bar
   echo '<div class="search_box">';
   echo '<form action="search.php" method="post">';
   echo '<input type="text" name="search_query" id="search_query" placeholder="Search here" required>';
   echo '<span class="icon">';
   echo '<button id="search_btn" type="submit" ""><ion-icon name="search-outline"></ion-icon></button>';
   echo '</span>';
   echo '</form>';
   echo '</div>';
   echo '</div>';
   echo' <script type="text/javascript" src="../javascript/sort.js"></script>';
   echo '</header>';
   
    
}

function outputFooter(){
    echo '</body>';
    echo '</html>';
}

?>

<script>
    function checkDashboard(){
        if(localStorage.length !== 0){
            document.getElementById('personIcon').style.display = block;
        }
    }

    checkDashboard();
</script>
