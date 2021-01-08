
const valueIsNotEmpty = ( value ) => {
    return value != "";
}

// getting online/offline users 
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

const setActiveTab = ( tab ) => {
    $( ".tabs-buttons > button.active" ).removeClass( "active" );
    $( ".tabs-content" ).hide();
    $( ".tabs-buttons [data-tab=" + tab + "]" ).addClass( "active" );
    $( "#" + tab + "Tab" ).show();
}
const hideLoginAndSignUp = () => {
    setActiveTab( "story" );
    $( ".tabs-buttons [data-tab=login]" ).hide();
    $( ".tabs-buttons [data-tab=signup]" ).hide();
};

// SO page load behavior
$(document).ready(function() {

    // success and error feedback  
    $('#err').hide();
    $('#succ').hide();

    getOnlineOfflineUsers();

    setActiveTab( "login" );

});
// EO page load behavior