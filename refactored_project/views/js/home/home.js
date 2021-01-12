
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

const setActiveTab = ( tab ) => {
    $( ".tabs-buttons > button.active" ).removeClass( "active" );
    $( ".tabs-content" ).hide();
    $( ".tabs-buttons [data-tab=" + tab + "]" ).addClass( "active" );
    $( "#" + tab + "Tab" ).show();
}

const hideLoginAndSignUpTabs = () => {
    setActiveTab( "story" );
    $( ".tabs-buttons [data-tab=login]" ).hide();
    $( ".tabs-buttons [data-tab=signup]" ).hide();
};

const triggerLoginSuccessBehavior = () => {
        // online users count is incremented on the front end
        getOnlineOfflineUsers();
        hideLoginAndSignUpTabs();
        $('#err').hide();
        $( "#succ" ).show();
        $( "#succ" ).html( "You are now logged in!" );
        $( ".grecaptcha-badge" ).hide();
}

const loginFeedback = loginSuccess => {
    if ( loginSuccess != undefined && loginSuccess != false && loginSuccess == true ) {
        triggerLoginSuccessBehavior();
    } else {
        $('#succ').hide();
        $('#err').html( "Invalid username or password!" );
        $('#err').show();
    }
};

const authenticator = new Authenticator( http );

const loginRequest = async ( username, password ) => {
    authenticator.loginWithCredentials( username, password ).then( outcome => {
        loginFeedback( outcome ); 
    });
}

const loginFromHomeForm = async () => {
    // optimistic assumption
    let validated  = true;
    const username = $( "#login-username" ).val();
    const password = $( "#login-password" ).val();
    [username, password].forEach( item => {
        validated = valueIsNotEmpty( item );
    });
    if ( !validated ) {
        $('#err').html( "You did not enter anything!" );
        $('#err').show();
    } else 
        loginRequest( username, password )
};

const signup = async () => {
    // optimistic assumption
    let validated         = true;
    let signupSuccess     = true;
    const confirmPassword = $('#confirm-password').val();
    const password        = $('#password').val();
    const email           = $('#email').val();
    const gender          = $( "#gender" ).val();
    const username        = $('#username').val();
    [username, password, confirmPassword, email].forEach( item => {
        validated = valueIsNotEmpty( item );
    });
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

                const signupPayload = {
                    confirmPassword: confirmPassword,
                    email          : email,
                    gender         : gender,
                    password       : password,
                    recaptchaToken : token,
                    username       : username
                };
                const headers = http.getHeaders();
                // send signup payload after generating Google Recaptcha token
                http.sendRequestWithPayload(
                    "/users",
                    "POST", 
                    signupPayload,
                    headers
                )
                .then( responseObject => {
                    responseObject.success ? signupSuccess = true : signupSuccess = false;
                })
                .catch( error => {
                    // uncomment to debug
                    // console.log(error); 
                    signupSuccess = false;
                }) 
                .finally( () => {
                    if ( signupSuccess ) {
                        $( "#succ" ).show();
                        $( "#succ" ).html( "You have signed up successfully!" );
                        // logging in after signup
                        loginRequest( username, password );
                    }
                });
            });
        });
    }
};

// SO page load behavior
jQuery( () => {

    $( "#signup_btn" ).on( "click", e => {
        e.preventDefault();
        signup();
    });

    authenticator.autoLogin().then( res => {
        if ( res == false || res == undefined ) 
            setActiveTab( "login" );
        else 
            triggerLoginSuccessBehavior();
    });

});
// EO page load behavior
