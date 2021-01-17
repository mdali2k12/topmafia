

class Authenticator {

    constructor( httpClient ) {
        this.httpClient = httpClient;
    }

    removeAuthDataFromLocalStorage() {
        localStorage.removeItem( "session" );
        localStorage.removeItem( "user" );
    }

    _setAuthTokenInHeaders( session ) {
        let headers = new Headers();
        headers.append( "Authorization", session.accessToken );
        this.httpClient.setHeaders( headers );
    }

    async autoLogin() {
        // pessimistic assumption about the outcome of the request
        let loginSuccess = false;
        let session, user;
        if ( localStorage.getItem( "session" ) != null && localStorage.getItem( "user" ) != null ) {
            try {
                session = JSON.parse( localStorage.getItem( "session" ) );
                user    = JSON.parse( localStorage.getItem( "user" ) );
                if ( this.checkValidSessionAndUser( session, user ) ) 
                    loginSuccess = true;
            } catch ( error ) {
                console.error( error );
            }
        }
        if ( loginSuccess === true ) {
            let headers = new Headers();
            headers.append( "Authorization", session.accessToken );
            headers.append( 'cache-control', 'no-cache');
            this.httpClient.setHeaders( headers );
            return this.httpClient.sendGetRequest( `/sessions/${session.id}` )
                .then( async responseObject => {
                    responseObject.success && responseObject.success != false ? loginSuccess = true : loginSuccess = false;
                    if ( responseObject.success == false ) // that means session is expired
                        await this.refreshSession( session ).then( outcome => {
                            loginSuccess = outcome;
                        })
                    if ( !loginSuccess ) 
                        this.removeAuthDataFromLocalStorage();
                    return loginSuccess;
                })
                .catch( error => {
                    console.error( error );
            });
        } else {
            this.removeAuthDataFromLocalStorage();
            return new Promise( ( resolve, reject ) => {
                resolve( false );
                reject( new Error( "something went wrong with autologin" ) )
            });
        }
    } // EO autoLogin method

    checkValidSessionAndUser( session, user ) {
        if ( 
            session == undefined
            || user == undefined
            || !session.hasOwnProperty( "id" )
            || !session.hasOwnProperty( "accessToken" )
            || !session.hasOwnProperty( "refreshToken" )
            || !session.hasOwnProperty( "userId" )
            || !user.hasOwnProperty( "email" )
        ) 
            return false;
        return true;
    }

    async loginWithCredentials( username, password ) {
        let loginSuccess = false;
        const headers    = this.httpClient.getHeaders();
        let authPayload  = {
            password       : password,
            username       : username
        };
        return this.httpClient.sendRequestWithPayload(
            "/sessions",
            "POST",
            authPayload,
            headers
        )
        .then( responseObject => {
            responseObject.success && !!responseObject.session && !!responseObject.user ? loginSuccess = true : loginSuccess = false;
            if ( loginSuccess != false ) {
                localStorage.setItem( "session", JSON.stringify( responseObject.session ) );
                localStorage.setItem( "user", JSON.stringify( responseObject.user ) );
            }
            return loginSuccess;
        })
        .catch( error => {
            return false;
        });
    }

    async refreshSession( session ) {
        let sessionRefreshSuccess = false;
        this._setAuthTokenInHeaders( session );
        let body = { refreshToken : session.refreshToken };
        return this.httpClient.sendRequestWithPayload( 
                `/sessions/${session.id}`,
                "PATCH",
                body, 
                this.httpClient.getHeaders()
            )
            .then( responseObject => {
                responseObject.success && responseObject.success != false ? sessionRefreshSuccess = true : sessionRefreshSuccess = false;
                if ( sessionRefreshSuccess != false ) {
                    session = responseObject.session;
                    localStorage.removeItem( "session" );
                    localStorage.setItem( "session", JSON.stringify( session ) );
                }
                return sessionRefreshSuccess;
            })
            .catch( error => {
                console.error( error );
        });
    }

}
