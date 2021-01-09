<?php

namespace App\Controllers\Resources;

use App\Controllers\Resources\ResourcesController;

use App\Http\Requests\Request;
use App\Http\Responses\Json\JsonResponse;

use App\Models\Session;
use App\Models\User;

use App\Validators\ArraysValidator;
use App\Validators\RecaptchaValidator;

class SessionsController extends ResourcesController {

    use ArraysValidator;
    use RecaptchaValidator;

    public function __construct( Request $request )
    {
        parent::__construct( $request );
    }

    // creating a session = logging in
    protected function _initCreateOneResponse(): void {
        $failed                 = true;
        $payload                = count( $this->_request->getBody() ) > 0 ? $this->_request->getBody() : [];
        $payloadMandatoryFields = isset( $payload["recaptchaToken"] ) ? 
                                    ["username", "password", "recaptchaToken"] : ["username", "password"];
        $session                = new Session();
        // validation rounds conditioning the creation of the session
        if ( 
            count( $payload ) > 0
            && $this->_matchKeyValuePairs( $payloadMandatoryFields ) 
        ) {
            $recaptchaValidationValue = isset( $payload["recaptchaToken"] ) ?
                                            $this->verifyRecaptchaResponse( $payload["recaptchaToken"] ) : true;
            $user                = new User( $payload["username"] );
            if ( $user->matchPasswords( $payload["password"] ) && $session->create( $user->getId() ) && $recaptchaValidationValue ) {
                $failed = false;
                // sending the user AND the session on login success
                $responsePayload            = $user->read();
                $responsePayload["session"] = $session->read();
                $this->_response            = new JsonResponse( 200, ["You are being logged in.."], true, $responsePayload );
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

}