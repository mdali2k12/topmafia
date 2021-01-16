
const valueIsNotEmpty = ( value ) => {
    return value != "";
}

// const appUrl = $(':hidden#app_url').val();
// let http = new HttpClient( null, appUrl ); // case deployment issues
let http = new HttpClient();

// SO getting online/offline users 
const getOnlineOfflineUsers = async () => {
    http.sendGetRequest( "/users" )
        .then( response => {
            $( "#playersCount" ).html( response.playersCount );
            $( "#onlinePlayersCount" ).html( response.onlinePlayersCount );
        })
        .catch( error =>  {
            console.log( error ); // TODO better error handling ?
    });
};
// EO getting online/offline users 