<?php

namespace App\Controllers\Resources;

use App\Controllers\Resources\ResourcesController;
use App\Http\Requests\Request;
use App\Http\Responses\Json\JsonResponse;

use App\Models\Session;
use App\Models\User;

use App\Validators\ArraysValidator;
use App\Validators\AuthValidator;

class SessionsController extends ResourcesController {

    use AuthValidator;
    use ArraysValidator;

    public function __construct( Request $request )
    {
        parent::__construct( $request );
    }

    private function _setLoggedInResponse() : void {
        $this->_response = new JsonResponse( 200, ["You are being logged in.."], true );
    }

    private function _setSessionExpiredResponse() : void {
        $this->_response = new JsonResponse( 200, ["Your session is expired!"], false );
    }

    /**
     * 
     * posting (e.g. creating) a session
     * means logging in for the next x minutes of expiry time
     * defined in seconds under the "ACCESS_TOKEN_EXPIRY" key of the .env file;
     * 
     * for this process, we need to verify that
     *  - the user exists
     *  - the password is valid
     * 
     * when a session is created it's part of the business logic that 
     * all other sessions are deleted for the considered user;
     * business logic rules belong to the Session model,
     * which has built-in removal of user-related sessions in its create method
     * 
     */
    protected function _initCreateOneResponse(): void {
        // pessimistic assumption
        $failed                   = true;
        $payload                  = count( $this->_request->getBody() ) > 0 ? $this->_request->getBody() : [];
        $payloadMandatoryFields   = ["username", "password"];
        // validation rounds
        if ( 
            count( $payload ) > 0
            && $this->_matchKeyValuePairs( $payloadMandatoryFields ) 
            && User::exists( $payload["username"] )
            && $this->validateUserPassword( $payload["password"], $payload["username"] )
        ) {
            $user    = new User( $payload["username"] );
            $session = new Session();
            if ( $session->create( $user->getId() ) ) {
                $failed = false;
                // sending the user AND the session back on login success
                $responsePayload            = $user->read();
                $responsePayload["session"] = $session->read();
                $this->_response            = new JsonResponse( 200, ["You are being logged in.."], true, $responsePayload );
            } else $this->_setServerErrorResponse( "We were unable to log you in, please try again later." );
        } 
        if ( $failed != false ) $this->_response = new JsonResponse( 200, ["Invalid username or password!"], false );
    } // EO _initCreateOneResponse() method

    protected function _initReadAllResponse(): void {
        $this->_setUnauthorizedResponse();
    }

    /**
     * 
     * checking valid session
     * by verifying if =>
     *  that the session id is indeed an int
     *  there is an auth header
     *  that it is not empty
     *  that session id from request url references an existing session
     *  that session id from request url and provided access token match
     *  that the access token provided in the header is not expired 
     * 
     */
    protected function _initReadOneResponse(): void {
        if (
            $this->_request->hasValidIntIdentifier()
            && $this->authHeaderIsProvided()
            && $this->authHeaderIsNotNullish()
            && Session::exists( $this->_request->getIdentifier() )
            && $this->validateTokenAndSessionIdAssociation( $this->getProvidedAccessToken(), $this->_request->getIdentifier() )
            && !$this->tokenIsExpired( $this->_request->getIdentifier(), "accessToken" )
        )
            $this->_setLoggedInResponse();
        else $this->_setUnauthorizedResponse();
    }

    /**
     * 
     * refreshing a session,
     * this means using the refresh token of the session 
     * to add 15 minutes from now to current session access token expiry;
     * to do this, we need to verify =>
     *  that the request identifier is a valid int
     *  that there is an auth header
     *  that it is not empty
     *  that session id from request url references an existing session
     *  that the access token provided in the header is indeed expired
     *  that there is a refresh token in the request body and the expected payload is valid
     *  that session id from request url, the provided access token, and the provided refresh token match
     *  that the provided refresh token is not expired;
     * we then refresh the session and send it back (updated) with the response
     * 
     */
    protected function _initUpdateOneResponse(): void {
        $payload                = count( $this->_request->getBody() ) > 0 ? $this->_request->getBody() : [];
        $payloadMandatoryFields = ["refreshToken"];
        // validation rounds
        if ( 
            $this->_request->hasValidIntIdentifier()
            && $this->authHeaderIsProvided()
            && $this->authHeaderIsNotNullish()
            && Session::exists( $this->_request->getIdentifier() )
            && $this->tokenIsExpired( $this->_request->getIdentifier(), "accessToken" )
            && count( $payload ) > 0
            && $this->_matchKeyValuePairs( $payloadMandatoryFields ) 
            && $this->validateTokensAndId( $this->getProvidedAccessToken(), $payload["refreshToken"], $this->_request->getIdentifier() )
            && !$this->tokenIsExpired(  $this->_request->getIdentifier(), "refreshToken" )
        ) {
            $session = new Session( $this->_request->getIdentifier() );
            $session->refreshAccessToken();
            $responsePayload["session"] = $session->read();
            $this->_response = new JsonResponse( 200, ["You are being logged in.."], true, $responsePayload );
        } 
        else $this->_setUnauthorizedResponse();
    }

}