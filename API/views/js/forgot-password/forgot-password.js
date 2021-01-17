
const sendResetPasswordEmail = async ( email ) => {
    grecaptcha.ready( () => {
        grecaptcha.execute( 
            $(':hidden#grecaptcha_site_key').val(), 
            {action: 'forgotPassword'}
        ).then( ( token ) => {
            http.sendRequestWithPayload( 
                "/emails", "POST", 
                {
                    email         :email, 
                    type          :"passwordreset",
                    recaptchaToken: token
                } 
            ).then( responseObject => {
                if ( responseObject != undefined && responseObject.success == true ) {
                    $( "#succ" ).show();
                    $( "#succ" ).html( `<p>An email with a link to reset your password was sent to ${$( "#email" ).val()}.</p>` );
                } else {
                    $( "#err" ).show();
                    if( responseObject.messages.Email )
                        $( "#errMess" ).html( `${responseObject.messages.Email}` );
                    else 
                        $( "#errMess" ).html( `There was an issue delivering your email. Please try again later.` );
                }
            })
            .catch( error => {
                console.error( error );
        });});
    });
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
        // we validate the email on client side
        if ( !validateEmail( $( "#email" ).val() ) ) {
            $( "#err" ).show();
            $( "#errMess" ).html( "Email is incorrect or invalid! </div> <br /><br /><center> Please try Again </center>" )
        } else {
            $( "#err" ).hide();
            sendResetPasswordEmail( $( "#email" ).val() );
        }
    });

});
// EO page load behavior