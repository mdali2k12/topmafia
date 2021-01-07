
//  SO login function
const login = function() {
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
// EO login function

// SO signUp function
const signUp = async () => {
    const confirmPassword = $('#confirm-password').val();
    const password        = $('#password').val();
    const email           = $('#email').val();
    const gender          = $( "#gender" ).val();
    const username        = $('#username').val();
    let validated = true;
    [username, password, confirmPassword, email].forEach( item => {
        validated = valueIsNotEmpty( item );
    });
    if ( !validated || confirmPassword !== password ) {
        $('#succ').hide();
        $('#err').html("Please fill all the fields correctly!");
        $('#err').show();
    } else {
        grecaptcha.ready( () => {
            grecaptcha.execute( 
                $(':hidden#grecaptcha_site_key').val(), 
                {action: 'signUp'}
            ).then( ( token ) => {
                // send register payload after generating Google Recaptcha token
                fetch( "/users", { // or appUrl + "/passwords", depending on your deployment env.
                    method: "POST",
                    body: JSON.stringify({
                        confirmPassword: confirmPassword,
                        email          : email,
                        gender         : gender,
                        password       : password,
                        recaptchaToken : token,
                        username       : username
                    }),
                    headers: {
                        "Content-type": "application/json; charset=UTF-8",
                        "json"        : "true"
                    }
                })
                // TODO show and hide error/success divs depending on the outcome of the registration
                // TODO case success => 
                    // $(".tabs-buttons [data-tab=register]").removeClass("active");
                    // $(".tabs-buttons [data-tab=login]").addClass("active");
                    // $(".tabs-content [data-tab=register]").removeClass("active");
                    // $(".tabs-content [data-tab=login]").addClass("active");
                // TODO hide recaptcha on success
                // TODO display validation errors to the user
                // TODO log the user in
                // TODO send verification email with one-time link
                .then( response => response.json() ) 
                .then(json => {
                    console.log( json ); // TODO
                })
                .catch( err => console.log(err) );
            });
        });
    }
};
// EO signUp function