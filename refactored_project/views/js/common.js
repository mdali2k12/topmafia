
const valueIsNotEmpty = ( value ) => {
    return value != "";
}

// SO getting online/offline users 
const getRequestToUsersEndpoint = async ( url ) => {
    var xmlHttp = new XMLHttpRequest();
    xmlHttp.open( "GET", url, false );
    xmlHttp.setRequestHeader( "json","true" );
    xmlHttp.send( null );
    return xmlHttp.responseText;
}
const getOnlineOfflineUsers = async () => {
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
};
// EO getting online/offline users 

// SO function to check user logged in state
const loggedInStateCheck = async () => {
    let session;
    let user;
    let loginSuccess;
    if ( localStorage.getItem( "session" ) != null && localStorage.getItem( "user" ) != null ) {
        try {
            session = JSON.parse( localStorage.getItem( "session" ) );
            user    = JSON.parse( localStorage.getItem( "user" ) );
        } catch ( e ) {
            console.error( "parsing local storage error:", e );
        }
    }
    else
        return false;
    if ( 
        session == undefined
        || user == undefined
        || !session.hasOwnProperty( "id" )
        || !session.hasOwnProperty( "accessToken" )
        || !session.hasOwnProperty( "userId" )
    ) 
        return false;
    else {
        await fetch( "/auth", { // or appUrl + "/auth", depending on your deployment env.
            method: "POST",
            body: JSON.stringify({
                sessionId: session.id,
                userId   : session.userId
            }),
            headers: {
                "Authorization": session.accessToken,
                "Content-type" : "application/json; charset=UTF-8",
                "json"         : "true"
            }
        })
        .then( response => { 
            // uncomment to debug
            // response.text().then( res => {console.log( res ); debugger;} );
            return response.json()
        } ) 
        .then( json => {
            json.success && json.success != false ? loginSuccess = true : loginSuccess = false;
        })
        .catch( err => {
            // uncomment to debug
            // console.log(err); 
            loginSuccess = false;
        })
        .finally( () => {
            // TODO if fails but valid session/user association, then patch request with refresh token + same header to endpoint
            // TODO if previous operation success session is refreshed and access token gains fifteen minutes expiry time starting now
            // TODO if previous operation success update local storage with new access token
        });
        return loginSuccess;
    }
}
// EO function to check user logged in state

// SO page load behavior
$(document).ready(function() {

    // success and error feedback  
    $('#err').hide();
    $('#succ').hide();

    getOnlineOfflineUsers();

});
// EO page load behavior