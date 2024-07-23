<nav class="sidebar close">

    <?php
        include ("cmsCommon.php");
        include ("functions.php");
    ?>

</nav>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Admin Login</title>
    <link rel="stylesheet" href="../CSS/loginpage.css">
</head>
<body>

<!--CONTAINER FOR THE LOG IN BOX-->
<div class="container">

<!--    CONTAINER THAT HAS THE INPUT FIELDS-->
    <div class="form-container">

        <!-- FORM SECTION-->
        <form>
            <h1>Sign in</h1>
            <label>
                <input id="username" type="text" name="username" placeholder="User ID" />
            </label>
            <label >
                <input id="password" type="password" name="password" placeholder="Password" />
            </label>
            <button type="submit" onclick="loginStaff()">Sign In</button>
        </form>

    </div>

<!--    Form Picture section-->
    <div class="overlay-container">

        <div class="overlay">
            <div class="overlay-panel">
                <h1>Welcome Back!</h1>
            </div>
        </div>

    </div>

</div>
<script src="../JS/script.js"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</body>
</html>
