
class HttpClient {

    constructor ( headers = null ) {
        this.setHeaders( headers );
    }

    _debugResponses( response ) {
        response.text().then( textFromServer => console.log( textFromServer ) ); debugger;
    }

    // SO getters/setters
    getHeaders() {
        return this.headers;
    }
    setHeaders( headerVal ) {
        if ( headerVal == null || headerVal == undefined ) {
            headerVal = new Headers();
        }
        headerVal.append( "json", "true" );
        headerVal.append( "Content-Type", "application/json" );
        this.headers = headerVal;
    }
    // EO getters/setters

    async sendGetRequest( url ) {
        let requestInit = {
            method : 'GET',
            mode   : 'cors',
            cache  : 'default'
        }
        requestInit.headers = this.headers;
        return fetch( url, requestInit )
            .then( response => { 
                // uncomment to debug
                // this._debugResponses( response );
                return response.json(); 
        });
    }

    async sendRequestWithPayload( url, method, body ) {
        return fetch( 
            url, 
            {
                method : method,
                body   : JSON.stringify(body),
                headers: this.headers
            }
        ).then( response => { 
            // uncomment to debug
            // this._debugResponses( response ); debugger;
            return response.json(); 
        });
    }

    useAppUrlFromEnvInstead( appUrlFromEnv, endpoint ) {
        return appUrlFromEnv + endpoint;
    }

}