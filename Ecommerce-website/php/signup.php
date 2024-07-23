<?php
$pageTitle = "Signup";
//Include the PHP functions to be used on the page 
include('common.php'); 
    
//Output header and navigation 
output_title($pageTitle);
outputNavigation($pageTitle);
?>
    
<!-- header section starts  -->
<title>Sign Up</title>
</head>
<body>
<!-- header section ends -->

<!-- action="signup_server.php" method="post" -->
  
  <!-- Sign up page -->
  <div class="container">
    <div class="login-form">
      <form autocomplete="off" id="signupForm">
        <h1>Sign Up</h1><!-- Sign up page header -->
        <p>
          Please fill in this form to create an account. or
          <a href="login.php">Login</a>
        </p>
        <div class="form-message"></div>
        <label for="Name">Name</label>
        <input type="text" placeholder="Enter Name" name="name" />
          
        <label for="em">Address</label>
        <input type="text" placeholder="Enter Address" name="address"  />
          
        <label for="Telephone Number">Telephone Number</label>
        <input type="text" placeholder="Enter Telephone Number" pattern="[0-9]{8}" title="8-digits only!" name="number" />
          
        <label for="email">Email</label>
        <input type="text" placeholder="Enter Email" name="email"  />

        <label for="psw">Password</label>
        <input type="password" placeholder="Enter Password" name="psw" pattern=".{8,}" title="Eight or more characters required!" />

        <label for="psw-repeat">Confirm Password</label>
        <input type="password" placeholder="Confirm Password" name="psw-repeat" />

        <label>
          <input type="checkbox" checked="checked" name="remember" style="margin-bottom: 15px"/>
          Remember me
        </label>

        <p>
          By creating an account you agree to our
          <a href="#">Terms & Privacy</a>.
        </p>

        <div class="buttons">
          <button type="button" class="cancel-button" onclick="window.location.href='home.php'">Cancel</button>
          <button type="submit" class="signupbtn" >Sign Up</button>
        </div>
      </form>
    </div>
  </div>
  <script type="text/javascript" src="../javascript/registration.js"></script>
    
<?php
include "footer.php";
?>

</body>

