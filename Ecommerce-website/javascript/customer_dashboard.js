$(document).ready(function() {
    // executed when edit button is clicked
    $("#edit-btn").click(function() {
        // AJAX request sent to server 
        $.ajax({
            url: "dashboard_server.php",
            type: "POST",
            data: { email: "<?php echo $_SESSION['loggedinUser']; ?>" },
            dataType: "json",
            success: function(response) {
                // populates form fields 
                $("#customer_profile #name").val(response.name);
                $("#customer_profile #address").val(response.address);
                $("#customer_profile #number").val(response.number);
                $("#customer_profile #email").val(response.email);
                $("#customer_profile #password").val(response.psw);
                $("#customer_profile #password-repeat").val(response.psw-repeat);
            }
        });
    });
});
 