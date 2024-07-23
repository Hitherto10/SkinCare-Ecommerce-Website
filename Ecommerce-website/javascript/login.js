// jQuery syntax to handle form submiision
$(document).ready(function() {
    // e.preventDefault() prevents form from submitting
    $("#loginForm").on('submit',function(e) {
        e.preventDefault();

        let user_email = $('#user_email').val();
        
        // AJAX request sent to server to submit the form
        $.ajax({
            type:"POST",
            url:"login_server.php",
            data:new FormData(this),
            dataType:"json",
            contentType:false,
            cache:false,
            processData:false,
            success:function(response) {
                $(".form-message").css("display","block");

                // handle reponse from server and display error messages
                if (response.status === 1) {
                    // resets form upon successful submission
                    $("#loginForm")[0].reset();
                    localStorage.setItem('LoggedInUser', user_email);
                    $(".form-message").html('<p>'+response.message + '</p>')
                } else {
                    $(".form-message").css("display","block");
                    $(".form-message").html('<p>'+response.message + '</p>')

                }
            }
        });
    });
  });


