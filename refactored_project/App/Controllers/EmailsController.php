<?php

namespace App\Controllers;

use App\Helpers\StringsTrait; 

use App\Http\Requests\Request;
use App\Http\Requests\PostRequest;
use App\Http\Responses\Json\JsonResponse;
use App\Models\User;

use App\Services\EmailsService;
use App\Services\LoggerService;

use App\Validators\RecaptchaValidator;
use App\Validators\StringsValidator;

class EmailsController extends Controller {

    use RecaptchaValidator;
    use StringsTrait;
    use StringsValidator;

    public function __construct( Request $request ) {
        parent::__construct( $request );
    }

    protected function _initResponse() : void {
        LoggerService::getInstance()->log( "info", "RESPONSE FROM EMAILS CONTROLLER" );
        // pessimistic assumption
        $success = false;
        switch( $this->_request->getMethod() ) {
            case "POST":
                $type  = isset( $this->_request->getBody()["type"] ) ? $this->_request->getBody()["type"] : "";
                $email = isset( $this->_request->getBody()["email"] ) ? $this->_request->getBody()["email"] : "";
                if ( 
                    $this->_request->isValid() 
                    && $this->sanitizeStringInput( $email ) != ""
                    && $this->sanitizeStringInput( $type ) != ""
                    && in_array( $type, explode( ',', $_ENV["ALLOWED_APP_TOKENS"] ) )
                    && $this->validateEmail( $email )
                ) {
                    $emailsService = new EmailsService();
                    $user          = new User( $email );
                    if ( !User::exists( $email ) ) {
                        $this->_addValidationError( "Email", "Sorry, no user with that email was found." );
                    } else {
                        switch ($type) {
                            case 'accountverification':
                                $success = $emailsService->sendAccountVerificationEmail( $user );
                                break;
                            case 'passwordreset':
                                $success = 
                                    isset( $this->_request->getBody()["recaptchaToken"] )
                                    && $this->verifyRecaptchaResponse( $this->_request->getBody()["recaptchaToken"] )
                                    && $emailsService->sendPasswordResetEmail( $user );
                                break;                        
                            default:
                                $this->_setBadRequestResponse();
                                break;
                        }
                    }
                } 
        }
        if ( $success == false ) $this->_response = new JsonResponse( 200, $this->getValidationErrors(), false );
        else $this->_response = new JsonResponse( 200, ["password reset link sent to ".$email], true );
    } // EO _initResponse( method

} // EO class