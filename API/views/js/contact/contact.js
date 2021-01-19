
const sendContactForm = async ( email, msg ) => {
    grecaptcha.ready( () => {
        grecaptcha.execute( 
            $(':hidden#grecaptcha_site_key').val(), 
            {action: 'sendContactForm'}
        ).then( ( token ) => {
            http.sendRequestWithPayload( 
                "/emails", "POST", 
                {
                    email         : email, 
                    type          : "contactform",
                    msg           : msg,
                    recaptchaToken: token
                } 
            ).then( responseObject => {
                if ( responseObject != undefined && responseObject.success == true ) {
                    $( "#succ" ).show();
                    $( "#succ" ).html( `${responseObject.messages[0]}` );
                } else loopThroughValidationErrorsFeedbacks( responseObject, "<p>Sorry something went wrong with your contact form!</p>" );
            })
            .catch( error => {
                console.error( error );
        });});
    });
};

jQuery( () => {

    hideFeedbackDivsIfAny();

    $( "#send_contact_form_btn" ).on( "click", (e) => {
        sendContactForm( $( "#email" ).val(), $( "#msg" ).val() );
    });

});