
// SO functions that will be used throughout the frontend app'

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

const hideFeedbackDivsIfAny = () => {
    if ( $( "#err" ).length ) $( "#err" ).hide();
    if ( $( "#succ" ).length ) $( "#succ" ).hide();
}

const loopThroughValidationErrorsFeedbacks = ( responseObject, defaultMessage ) => {
    let errorFeedbacks = defaultMessage;
    if ( responseObject["validation errors"] ) {
        for ( let errorFeedback in responseObject["validation errors"] ) {
            errorFeedbacks += `<p>${responseObject["validation errors"][errorFeedback]}</p>`;
        }
    } 
    $( "#err" ).show();
    $( "#err" ).html( errorFeedbacks );
}

const valueIsNotEmpty = ( value ) => {
    return value != "";
};
const validateEmail = (email) => {
    const re = /^(([^<>()[\]\\.,;:\s@"]+(\.[^<>()[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
    return re.test(String(email).toLowerCase());
};

// EO functions that will be used throughout the frontend app'

// setting up the HTTP client that will be used throughout the frontend app'
// const appUrl = $(':hidden#app_url').val();
// let http = new HttpClient( null, appUrl ); // case deployment issues
let http = new HttpClient();

// setting up the authenticator
const authenticator = new Authenticator( http );

// updating offline/users on page load
window.onload=getOnlineOfflineUsers;
