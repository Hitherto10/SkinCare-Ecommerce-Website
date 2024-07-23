// jQuery syntax to handle form submiision
$(document).ready(function() {
    // e.preventDefault() prevents form from submitting
    $("#signupForm").on('submit',function(e) {
        e.preventDefault();
        
        // AJAX request sent to server to submit the form
        $.ajax({
            type:"POST",
            url:"signup_server.php",
            data:new FormData(this),
            dataType:"json",
            contentType:false,
            cache:false,
            processData:false,
            success:function(response) {
                $(".form-message").css("display","block");

                // handle reponse from server and display error messages
                if (response.status == 1) {
                    // resets form upon successful submission
                    $("#signupForm")[0].reset();
                    $(".form-message").html('<p>'+response.message + '</p>')
                } else {
                    $(".form-message").css("display","block");
                    $(".form-message").html('<p>'+response.message + '</p>')
                }
            }
        });
    });
  });

  
