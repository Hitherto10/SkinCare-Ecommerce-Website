<?php

function head(){
    echo    "<!DOCTYPE html>";
    echo    "<html lang=\"en\">";
    echo    "<head><title>Sidebar</title></head>";


//          HEADER TITLE AND LINKS
    echo    "    <meta charset=\"UTF-8\">";
    echo    "    <title> Content Management System</title>";
    echo    "    <link rel=\"stylesheet\" href=\"../CSS/styles.css\">";
    echo    "    <link href='https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css' rel='stylesheet'>";
    echo    "    <link href=\"https://cdn.jsdelivr.net/npm/remixicon@2.5.0/fonts/remixicon.css\" rel=\"stylesheet\">";
    echo    "    <meta name=\"viewport\" content=\"width=device-width, initial-scale=1.0\">";
    echo    "</head>";


//           General CMS page
    echo    "<header class=\"cmsLogo\">";
    echo    "    <i class='bx bx-store'></i>";
    echo    "    <span class=\"logo_name\"><b>Admin Page</b></span>";
    echo    "</header>";


//    NAVIGATION LINKS 'HOME'
    echo    "<ul class=\"nav-links\" id=\"navigation\">";
    echo    "    <li>";
    echo    "        <a href=\"home.php\">";
    echo    "            <i class=\"bx bxs-dashboard\" style='color:#fff ; font-size: 26px' ></i>";
    echo    "            <span class=\"link_name\">Home</span>";
    echo    "        </a>";
    echo    "   </li>";


//    NAVIGATION LINK 'DATABASE'
    echo    "<li>";
    echo    "        <div class=\"icon-link\">";
    echo    "            <a>";
    echo    "                <i class='bx bxs-data'></i>";
    echo    "                <span class=\"link_name\">Edit Database</span>";
    echo    "            </a>";
    echo    "            <i class='bx bxs-chevron-down arrow' ></i>";
    echo    "        </div>";


//              DROP DOWN MENU FOR EDITING THE DATABASE
    echo    "        <ul class=\"sub-menu\">";
    echo    "            <li><a href=\"products.php\">Manage products</a></li>";
    echo    "            <li><a style=\"cursor: pointer\" onclick=addMenu() >Add products</a></li>";
    echo    "            <li><a style=\"cursor: pointer\" onclick=inputEditId() >Edit products</a></li>";
    echo    "        </ul>";
    echo    "    </li>";


//    PROFILE DETAILS ON SIDE BAR
    echo    "<div class=\"details_Container\">";
    echo    "        <div class=\"user-icon\">";
    echo    "            <img src=\"../assets/man.png\" alt=\"profileImg\">";
    echo    "        </div>";

    echo    "        <div class=\"name-job\">";
    echo    "            <div class=\"profile_name\" >";
    echo    "        </div>";

    echo    "        <div class=\"job\">STAFF</div>";
    echo    "</div>";

    //    END AND CLEAR SESSION DATA
    function staffLogout(){
        session_destroy();
    }
    ?>

    <a id="logout_link" href="staffLogin.php" onclick="<?php staffLogout()?>" class="logoutBTNlink"><button onclick="logout()" class="lgn-btn">Logout</button></a>

    <?php
    echo    "    </div>";

?>

<script>
    // set name text to username when logged in
    const username = sessionStorage.getItem('LoggedInUser');
    document.querySelector('.profile_name').textContent = username;

    // if no user i =s logged in set the log-out button to log in
    if (username == null){
        document.querySelector('.lgn-btn').textContent = 'Log In';
    }

    function logout(){
            sessionStorage.clear();
    }

</script>

<?php
}
