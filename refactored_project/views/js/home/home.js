
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
    let signUpSuccess;
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
                // uncomment to debug
                // console.log( token ); debugger;
                // send signup payload after generating Google Recaptcha token
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
                .then( response => { 
                    return response.json()
                        // uncomment to debug
                        // .then( res => console.log( res ) );
                } ) 
                .then( json => {
                    json.success ? signUpSuccess = true : signUpSuccess = false;
                })
                .catch( err => {
                    // uncomment to debug
                    // console.log(err); 
                    signUpSuccess = false;
                }) 
                .finally( () => {
                    if ( signUpSuccess != undefined && signUpSuccess != false && signUpSuccess == true ) {
                        getOnlineOfflineUsers();
                        hideLoginAndSignUp();
                        $( "#succ" ).show();
                        $( "#succ" ).html( "You have signed up successfully!" );
                    }
                });
                // TODO show and hide error/success divs depending on the outcome of the registration
                // TODO case error show validation errors
                    // "Invalid E-mail address format"
                    // "You must enter a password."
                    // "You must fill in both password fields"
                    // "Your email has been banned"
                    //  "Sorry the Username you entered is too short"
                    // "Sorry the Username you entered is too long"
                    // "You entered invalid characters in your username Keep it simple."
                    // "You entered invalid characters in your password."
                    //  "The Username you entered is in use."
                    // "The E-mail you entered is in use."
                    //  "Your passwords do not match."
                // TODO hide recaptcha on success
                // TODO log the user in
                // TODO send verification email with one-time link
                    /** 
                     * based on this template =>
                     * <html>
                            <body>
                                <h2>Your login details for Top Mafia!</h2>
                                <p>Your username is <strong>".htmlspecialchars($username)."</strong></p>
                                <p>Your password is <strong>".htmlspecialchars($password)."</strong> </p>
                                <p>Email verification code <strong> ".htmlspecialchars($verify_code)."</strong></p>- head back to <a href='https://www.topmafia.net/'>Top Mafia</a></p>
                            </body>
                        </html> 
                        $mail->AddReplyTo("webmail@topmafia.net","Top Mafia");
                        $mail->SetFrom('webmail@topmafia.net', 'Top Mafia');
                        $mail->AddAddress($to);
                        $mail->Subject  = "Your login details for Top Mafia!";
                    */
            });
        });
    }
};
// EO signUp function