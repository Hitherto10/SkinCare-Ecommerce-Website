<?php
$pageTitle = "Login";
//Include the PHP functions to be used on the page 
include('common.php'); 
    
//Output header and navigation 
output_title($pageTitle);
outputNavigation($pageTitle);
?>
    
<!-- header section starts  -->
<title>Login</title>
</head>
<body>

<!-- Login -->
<div class="container">
  <div class="login-form">
    <form autocomplete="off" id="loginForm">
      <h1>Login</h1><!-- login section header -->
      <p>
        Already have an account? Log in or
        <a href="signup.php">Sign Up</a>
      </p>

      <div class="form-message"></div>
      <label for="email">Email</label>
      <input type="text" id="user_email" placeholder="Enter Email" name="email" />

      <label for="psw">Password</label>
      <input type="password" placeholder="Enter Password" name="psw" />

      <label>
        <input type="checkbox" checked="checked" name="remember" style="margin-bottom: 15px" />
        Remember me
      </label>

      <p>
        By creating an account you agree to our
        <a href="#">Terms & Privacy</a>.
      </p>
      
      <button type="submit">Login</button>
    </form>
  </div>
</div>
<script type="text/javascript" src="../javascript/login.js"></script>
<?php
include "footer.php";
?>


</body>
