
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

// SO login-related functions
const updateSession = async ( session ) => {
    let sessionUpdateSuccess = false;
    await fetch( "/sessions/" + session.id, { // or appUrl + "/sessions", depending on your deployment env.
        method: "PATCH",
        body: JSON.stringify({
            refreshToken: session.refreshToken,
        }),
        headers: {
            "Authorization": session.accessToken,
            "Content-Type" : "application/json",
            "json"         : "true"
        }
    })
    .then( response => { 
        // uncomment to debug
        // response.text().then( res => {console.log( res ); debugger;} );
        return response.json()
    } ) 
    .then( json => {
        // uncomment to debug
        json.success && json.success != false ? sessionUpdateSuccess = true : sessionUpdateSuccess = false;
        if ( sessionUpdateSuccess != false ) {
            session.accessTokenExpiry = json.session.accessTokenExpiry;
            localStorage.removeItem( "session" );
            localStorage.setItem( "session", JSON.stringify( session ) );
        }
    })
    .catch( err => {
        // uncomment to debug
        // console.log(err); 
        sessionUpdateSuccess = false;
    })    
    return sessionUpdateSuccess;
}
const loggedInStateCheck = async () => {
    let session;
    let user;
    let loginSuccess;
    let sessionIsExpired;
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
        || !session.hasOwnProperty( "refreshToken" )
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
                "Content-type" : "application/json",
                "json"         : "true"
            }
        })
        .then( response => { 
            // uncomment to debug
            // response.text().then( res => {console.log( res ); debugger;} );
            return response.json()
        } ) 
        .then( json => {
            // uncomment to debug
            // console.log( json );
            json.success && json.success != false ? loginSuccess = true : loginSuccess = false;
            if ( json.success == false ) sessionIsExpired = true;
        })
        .catch( err => {
            // uncomment to debug
            // console.log(err); 
            loginSuccess = false;
        })
        .finally( async () => {
            if ( sessionIsExpired != undefined && sessionIsExpired == true )
                await updateSession( session ).then( res => {loginSuccess = true} );
        });
        if ( loginSuccess == false ) {
            localStorage.removeItem( "session" );
            localStorage.removeItem( "user" );
        }
        return loginSuccess;
    }
}
// EO login-related functions

// SO page load behavior
$(document).ready(function() {

    // success and error feedback  
    $('#err').hide();
    $('#succ').hide();

    getOnlineOfflineUsers();

});
// EO page load behavior