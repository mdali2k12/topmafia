
const resetPassword = async ( tokenType, token, userid  ) => {
    authenticator.removeAuthDataFromLocalStorage();
    // optimistic assumption
    let validated           = true;
    let resetPasswordSucces = true;
    const confirmPassword   = $('#confirm-password').val();
    const password          = $('#password').val();
    [password, confirmPassword].forEach( item => {
        validated = valueIsNotEmpty( item );
    });
    if ( !validated || confirmPassword !== password ) {
        $('#err').html("Cannot proceed");
        $('#err').show();
    } else {
        grecaptcha.ready( () => {
            grecaptcha.execute( 
                $(':hidden#grecaptcha_site_key').val(), 
                {action: 'resetPassword'}
            ).then( ( GRtoken ) => {
                const resetPasswordPayload = {
                    confirmPassword: confirmPassword,
                    password       : password,
                    recaptchaToken : GRtoken,
                    tokenType      : tokenType,
                    appToken       : token 
                };
                const headers = http.getHeaders();
                // send signup payload after generating Google Recaptcha token
                http.sendRequestWithPayload(
                    `/users/${userid}`,
                    "PATCH", 
                    resetPasswordPayload,
                    headers
                )
                .then( responseObject => {
                    responseObject.success ? resetPasswordSucces = true : resetPasswordSucces = false;
                })
                .catch( error => {
                    // uncomment to debug
                    // console.log(error); 
                    resetPasswordSucces = false;
                }) 
                .finally( () => {
                    if ( resetPasswordSucces ) {
                        $( "#succ" ).show();
                        $( "#succ" ).html( "Your password has been reset successfully!" );
                    } else {
                        $( "#err" ).show();
                        $( "#err" ).html( "Something went wront while resetting your password." );                        
                    }
                });
            });
        });
    }
}

// SO page load behavior
jQuery( () => {

    // hiding error/success feedbacks divs
    $('#err').hide();
    $('#succ').hide();

    // updating offline/users on page load
    getOnlineOfflineUsers();

    $( "#pwd_reset_btn" ).on( "click", (e) => {
        e.preventDefault();
        if ( $( "#apptoken" ).length ) {
            const tokenType = $( "#apptoken" ).attr( "data-type" );
            const token     = $( "#apptoken" ).attr( "data-token" );
            const userid    = $( "#userid" ).attr( "data-userid" );
            resetPassword( tokenType, token, userid );
        } else {
            $( "#err" ).show();
            $( "#err" ).html( "Something went wront while resetting your password." );
        }
    });

});
// EO page load behavior