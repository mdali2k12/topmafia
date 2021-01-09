<?php

namespace App\Controllers\Resources;

use App\Controllers\Resources\ResourcesController;

use App\Http\Requests\Request;
use App\Http\Responses\Json\JsonResponse;

use App\Models\Session;
use App\Models\User;

use App\Validators\ArraysValidator;
use App\Validators\AuthValidator;
use App\Validators\RecaptchaValidator;

class SessionsController extends ResourcesController {

    use AuthValidator;
    use ArraysValidator;
    use RecaptchaValidator;

    public function __construct( Request $request )
    {
        parent::__construct( $request );
    }

    // creating a session = logging in
    protected function _initCreateOneResponse(): void {
        $failed                   = true;
        $payload                  = count( $this->_request->getBody() ) > 0 ? $this->_request->getBody() : [];
        $payloadMandatoryFields   = isset( $payload["recaptchaToken"] ) ? 
                                    ["username", "password", "recaptchaToken"] : ["username", "password"];
        $session                  = new Session();
        $recaptchaValidationValue = isset( $payload["recaptchaToken"] ) ?
                                        $this->verifyRecaptchaResponse( $payload["recaptchaToken"] ) : true;
        // validation rounds conditioning the creation of the session, e.g. logging in
        if ( 
            count( $payload ) > 0
            && $this->_matchKeyValuePairs( $payloadMandatoryFields ) 
            && $recaptchaValidationValue
        ) {
            $user = new User( $payload["username"] );
            if ( $user->getId() != 0 && $user->matchPasswords( $payload["password"] ) && $session->create( $user->getId() ) ) {
                $failed = false;
                // sending the user AND the session on login success
                $responsePayload            = $user->read();
                $responsePayload["session"] = $session->read();
                $this->_response            = new JsonResponse( 200, ["You are being logged in.."], true, $responsePayload );
                $session->deleteAllOtherUserSessions();
            }
        } 
        if ( $failed != false ) $this->_response = new JsonResponse( 200, ["Invalid username or password!"], false );
    } // EO _initCreateOneResponse() method

    protected function _initReadAllResponse(): void {
        $this->_setUnauthorizedResponse();
    }

    protected function _initReadOneResponse(): void {
        $this->_setUnauthorizedResponse();
    }

    protected function _initUpdateOneResponse(): void {
        print_r( $_SERVER['HTTP_USER_AGENT'] ); die();
        $payload                = count( $this->_request->getBody() ) > 0 ? $this->_request->getBody() : [];
        $payloadMandatoryFields = ["refreshToken"];
        $failure                = true;
        $session                = new Session( $this->_request->getIdentifier() );
        $sessionArr             = $session->read();
        if ( 
            $this->_request->isValid() 
            && ( ctype_digit( $this->_request->getIdentifier() ) || is_numeric( $this->_request->getIdentifier() ) )
            && count( $payload ) > 0
            && $this->_matchKeyValuePairs( $payloadMandatoryFields ) 
            && $this->authHeaderIsProvided()
            && $this->authHeaderIsNotNullish()
            && $sessionArr["id"] != 0
            && $sessionArr["accessToken"]  === $this->sanitizeStringInput( $this->removeSpaces( $_SERVER['HTTP_AUTHORIZATION'] ) ) 
            && $sessionArr["refreshToken"] === $payload["refreshToken"]
            && !$this->refreshTokenIsExpired( $sessionArr )
            && $session->refreshAccessToken()
        ) {
            $failure                    = false;
            $responsePayload["session"] = $session->read();
            $this->_response = new JsonResponse( 200, ["You are being logged in.."], true, $responsePayload );
        } 
        if ( $failure != false ) $this->_setUnauthorizedResponse();
    }

}