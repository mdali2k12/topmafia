//  login
const validateLogin = function() {
    var formData = new FormData(form);
    if ($('#username').val() == "" || $('#password').val() == "") {
        $('#err').html("You did not enter anything!");
        $('#err').show();
        $('#succ').hide();
    } else {
        $.ajax({
            processData: false,
            contentType: false,
            url: 'ajax/ajax_login.php',
            data: formData,
            type: 'POST',
            success: function(data) {
                var status = JSON.parse(data);
                $('#err').hide();
                    $('#succ').html(status.success);
                    $('#succ').show();
                if (typeof status.error != "undefined") {
                    $('#succ').hide();
                    $('#err').html(status.error);
                    $('#err').show();
                } else
                    window.location.href = '../index.php';
            }
        });
    }
};

// TODO signup
const signUp = async () => {

    const username        = $('#username').val();
    const password        = $('#password').val();
    const confirmPassword = $('#confirm-password').val();
    const email           = $('#email').val();

    // check that all fields are filled
    if (username == "" || password == "" || cpassword == "" || email == "" || ref == "") {
        $('#succ').hide();
        $('#err').html("Please fill all the fields correctly!");
        $('#err').show();
    } else {

        // TODO triggering grecaptcha
        grecaptcha.ready(function() {
            grecaptcha.execute( 
                $(':hidden#grecaptcha_site_key').val(), 
                {action: 'signUp'}
            ).then( function( token ) {
                    console.log( token );
                    // TODO Add your logic to submit to your backend server here.
                });
            });
        }
    

        // TODO send register payload
        // fetch( "/users", { // or appUrl + "/passwords"
        //     method: "POST",
        //     body: JSON.stringify({
        //         email:$( "#email" ).val()
        //     }),
        //     headers: {
        //         "Content-type": "application/json; charset=UTF-8",
        //         "json"        : "true"
        //     }
        //     })
        //     .then(response => response.json()) 
        //     .then(json => {
        //         console.log( json ); // TODO
        //     })
        //     .catch(err => console.log(err)
        // );

        // TODO show and hide error/success divs depending on the outcome of the registration
        // TODO case success => 
            // $(".tabs-buttons [data-tab=register]").removeClass("active");
            // $(".tabs-buttons [data-tab=login]").addClass("active");
            // $(".tabs-content [data-tab=register]").removeClass("active");
            // $(".tabs-content [data-tab=login]").addClass("active");
        // TODO display validation errors to the user
        // TODO log the user in
        // TODO send verification email with one-time link
    }
};