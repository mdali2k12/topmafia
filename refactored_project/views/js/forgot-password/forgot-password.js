

$ (document ).ready(function() {

    // const appUrl = $(':hidden#app_url').val();

    $( ".passwordReset" ).click( e => {
        e.preventDefault();
        // HTTP call to trigger the password reset flow
        fetch( "/passwords", { // or appUrl + "/passwords"
                method: "POST",
                body: JSON.stringify({email:$( "#email" ).val()}),
                headers: {
                    "Content-type": "application/json; charset=UTF-8",
                    "json"        : "true"
                }
            })
            .then(response => response.json()) 
            .then(json => {
                if ( json.success == false ) {
                    $( "#err" ).show();
                    $( "#errMess" ).html( json.messages[0] );
                } else $( "#succ" ).show();
            })
            .catch(err => console.log(err)
        );
    });

});