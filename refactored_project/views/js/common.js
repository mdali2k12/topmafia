
// SO page load behavior
$(document).ready(function() {

    // success and error feedback  
    $('#err').hide();
    $('#succ').hide();

    // getting online/offline users 
    const getRequestToUsersEndpoint = async ( url ) => {
        var xmlHttp = new XMLHttpRequest();
        xmlHttp.open( "GET", url, false );
        xmlHttp.setRequestHeader( "json","true" );
        xmlHttp.send( null );
        return xmlHttp.responseText;
    }
    // const appUrl = $(':hidden#app_url').val();
    // getRequestToUsersEndpoint( appUrl + "/users" ) // if deployment issues
    getRequestToUsersEndpoint( "/users" )
        .then( res => {
            const resObject = JSON.parse( res );
            $( "#playersCount" ).html( resObject.playersCount );
            $( "#onlinePlayersCount" ).html( resObject.onlinePlayersCount );
        })
        .catch( err => {
            // TODO better error handling
            console.log( err );
    });

});
// EO page load behavior