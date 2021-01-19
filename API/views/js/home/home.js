
const setActiveTab = ( tab ) => {
    hideFeedbackDivsIfAny();
    $( ".tabs-content" ).hide();
    $( ".tabs-buttons > button.active" ).removeClass( "active" );
    $( ".tabs-buttons [data-tab=" + tab + "]" ).addClass( "active" );
    $( "#" + tab + "Tab" ).show();
}

const triggerLoginFailureBehavior = ( feedbackMessage ) => {
    setActiveTab( "login" );
    $('#succ').hide();
    $('#err').html( feedbackMessage );
    $('#err').show();
}

const triggerLoginSuccessBehavior = ( feedbackMessage ) => {
        // online users count is incremented on the front end
        getOnlineOfflineUsers();
        setActiveTab( "story" );
        // hiding other content tabs
        $( ".tabs-buttons [data-tab='login']" ).hide();
        $( ".tabs-buttons [data-tab='signup']" ).hide();
        $('#err').hide();
        $( "#succ" ).show();
        $( "#succ" ).html( feedbackMessage );
        $( ".grecaptcha-badge" ).hide();
}

const loginFeedback = loginSuccess => {
    if ( loginSuccess != undefined && loginSuccess != false && loginSuccess == true ) 
        triggerLoginSuccessBehavior( "You are now logged in!" );
    else triggerLoginFailureBehavior( "Invalid username or password!" );
};

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
                    if ( signupSuccess ) {
                        $( "#succ" ).show();
                        $( "#succ" ).html( "You have signed up successfully!" );
                        // logging in after signup
                        loginRequest( username, password );
                    } else loopThroughValidationErrorsFeedbacks( responseObject, "<p>Sorry we could not sign you up!</p>" );
                })
                .catch( error => {
                    // uncomment to debug
                    // console.log(error); 
                }) 
            });
        });
    }
};
// EO signup function

// SO request to /apptokens endpoint
const getRequestToAppTokens = async ( type, token ) => {
    return http.sendGetRequest( `/apptokens?type=${type}&token=${token}` )
        .then( responseObject => { return responseObject;} )
        .catch( error =>  {
            console.log( error ); // TODO better error handling ?
    });
};
// EO request to /apptokens endpoint

const autoLoginBehavior = async ( feedbackMessage ) => {
    authenticator.autoLogin().then( res => {
        if ( res == false || res == undefined ) {
            authenticator.removeAuthDataFromLocalStorage();
            setActiveTab( "login" );
        }
        else 
            triggerLoginSuccessBehavior( feedbackMessage );
    });
}

const resendAccountVerificationEmail = async ( email ) => {
    http.sendRequestWithPayload( "/emails", "POST", {email:email, type:"accountverification"} ); 
}

// SO page load behavior
jQuery( () => {

    // setting active tab to "login" by default
    setActiveTab( "login" );

    // registering on click event for signup button
    $( "#signup_btn" ).on( "click", e => {
        e.preventDefault();
        signup();
    });

    // sending requests to app' tokens endpoint if input exists
    if ( $( "#apptoken" ).length ) {
        const tokenType = $( "#apptoken" ).attr( "data-type" );
        const token     = $( "#apptoken" ).attr( "data-token" );
        getRequestToAppTokens( tokenType, token )
            .then( responseObject => {
                if ( responseObject != undefined && responseObject.success != false ) {
                    // setting user and session in local storage
                    authenticator.removeAuthDataFromLocalStorage();
                    localStorage.setItem( "session", JSON.stringify( responseObject.session ) );
                    localStorage.setItem( "user", JSON.stringify( responseObject.user ) );
                    triggerLoginSuccessBehavior( "Thank you for having verified your account" );
                } 
                if ( responseObject != undefined && responseObject.success == false ) {
                    switch( responseObject.messages[0]) {
                        case "account verification failed":
                            let canResendEmail = false;
                            try {
                                session = JSON.parse( localStorage.getItem( "session" ) );
                                user    = JSON.parse( localStorage.getItem( "user" ) );
                                if ( authenticator.checkValidSessionAndUser( session, user ) ) 
                                    canResendEmail = true;
                            } catch ( error ) {
                                console.error( error );
                            }
                            if ( canResendEmail ) {
                                triggerLoginFailureBehavior( 
                                    `Account verification failed ! &nbsp;
                                    <input type='button' class='primary button' id='account_verif_btn' value='Resend verification email'>
                                `);
                                // registering on click event for account verification mail send button
                                $( "#account_verif_btn" ).on( "click", e => {
                                    e.preventDefault();
                                    resendAccountVerificationEmail( user.email );
                                    $( "#err" ).hide();
                                    $( "#succ" ).show();
                                    $( "#succ").html( "Account verification email sent !" );
                                });
                            } else 
                                triggerLoginFailureBehavior( `Account verification failed !`);
                            break;
                        case "account already verified":
                            autoLoginBehavior( `This account has been verified, no further action required` );
                            break;
                    }

                }
            })
            .catch( error => {
                console.error( error );
        });
    } else {
        // auto login
        autoLoginBehavior( "You are now logged in!" );
    }


});
// EO page load behavior
