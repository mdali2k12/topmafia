
//  SO login functions

/** *  TODO regarding sessions and logging in
*
* auto logging in on page landing
* 
* if token or credentials sent along an interaction request do not match the session record user id
* then the session record is destroyed;
* 
* if the user logs in on an another device or another browser,
* the session record in db is destroyed,
* as only one session associated to a user can exist at a time;
* 
* implement session hijacking protection
*
*/

const loginFeedback = loginSuccess => {
    if ( loginSuccess != undefined && loginSuccess != false && loginSuccess == true ) {
        // online users count is incremented
        getOnlineOfflineUsers();
        hideLoginAndSignUp();
        $( "#succ" ).show();
        $( "#succ" ).html( "You are now logged in!" );
        $( ".grecaptcha-badge" ).hide();
    } else {
        $('#succ').hide();
        $('#err').html( "Invalid username or password!" );
        $('#err').show();
    }
};
const loginRequest  = async ( username, password, token = null ) => {
    let payload;
    if ( token == null ) 
        payload = {
            password : password,
            username : username,
        };
    else payload = {
        password       : password,
        username       : username,
        recaptchaToken : token
    }
    fetch( "/sessions", { // or appUrl + "/sessions", depending on your deployment env.
        method: "POST",
        body: JSON.stringify( payload ),
        headers: {
            "Content-type": "application/json; charset=UTF-8",
            "json"        : "true"
        }
    })
    .then( response => { 
        return response.json()
            // uncomment to debug
            // .then( res => {console.log( res ); debugger;} ); 
    } ) 
    .then( json => {
        // console.log( json );
        json.success && !!json.session && !!json.user ? loginSuccess = true : loginSuccess = false;
        if ( loginSuccess != false ) {
            localStorage.setItem( "session", JSON.stringify( json.session ) );
            localStorage.setItem( "user", JSON.stringify( json.user ) );
        }
    })
    .catch( err => {
        // uncomment to debug
        // console.log(err); 
        loginSuccess = false;
    }) 
    .finally( () => {
        loginFeedback( loginSuccess );
    });
}
const loginFromForm = async () => {
    grecaptcha.ready( () => {
        grecaptcha.execute( 
            $(':hidden#grecaptcha_site_key').val(), 
            {action: 'signUp'}
        ).then( ( token ) => {
            let validated  = true;
            const username = $( "#login-username" ).val();
            const password = $( "#login-password" ).val();
            [username, password].forEach( item => {
                validated = valueIsNotEmpty( item );
            });
            let loginSuccess;
            if ( !validated ) {
                $('#err').html( "You did not enter anything!" );
                $('#err').show();
            } else {
                loginRequest( username, password, token );
            }
        });
    });
};
const loginOnSignUp = async ( username, password ) => {
    loginRequest( username, password );
};
// EO login functions

// SO signUp function
const signUp = async () => {
    const confirmPassword = $('#confirm-password').val();
    const password        = $('#password').val();
    const email           = $('#email').val();
    const gender          = $( "#gender" ).val();
    const username        = $('#username').val();
    let validated         = true;
    [username, password, confirmPassword, email].forEach( item => {
        validated = valueIsNotEmpty( item );
    });
    let signUpSuccess;
    if ( !validated || confirmPassword !== password ) {
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
                fetch( "/users", { // or appUrl + "/users", depending on your deployment env.
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
                    // uncomment to debug
                    // response.text().then( res => {console.log( res ); debugger;} );
                    return response.json()
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
                        $( "#succ" ).show();
                        $( "#succ" ).html( "You have signed up successfully!" );
                        // logging in after signup
                        loginOnSignUp( username, password );
                    }
                });
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
                    // TODO recaptcha validation failure feedback
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