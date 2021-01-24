<?php

namespace App\Controllers;

use App\Helpers\StringsTrait; 

use App\Http\Requests\Request;
use App\Http\Requests\PostRequest;
use App\Http\Responses\Json\JsonResponse;
use App\Models\User;

use App\Services\EmailsService;
use App\Services\LoggerService;
use App\Services\UsersService;

use App\Validators\RecaptchaValidator;
use App\Validators\StringsValidator;

class EmailsController extends Controller {

    use RecaptchaValidator;
    use StringsTrait;
    use StringsValidator;

    private UsersService $_usersService;

    public function __construct( Request $request ) {
        parent::__construct( $request );
        $this->_usersService = new UsersService();
    }

    private function _addToValidationErrorsIfUserDoesntExist( string $email ) : void {
        if ( !$this->_usersService->exists( $email ) )
            $this->_addValidationError( "Email", "Sorry, no user with that email was found." );
    }

    // used only with emails requesting app' tokens
    private function _checkIfValidAppTokenEmail( string $type ) : bool {
        return $this->sanitizeStringInput( $type ) != "" 
            && in_array( $type, explode( ',', $_ENV["ALLOWED_APP_TOKENS"] ) );
    }

    private function _performEmailingOperation( string $email, string $type ): bool {
        $success       = false;
        $emailsService = new EmailsService();
        switch ( $type ) {
            case "accountverification":
                $this->_addToValidationErrorsIfUserDoesntExist( $email );
                if ( 
                    $this->_checkIfValidAppTokenEmail( $type )
                    && $this->_hasNoValidationErrors() 
                ) {
                    $user    = new User( $email );
                    $success = $emailsService->sendAccountVerificationEmail( $user );
                }
                break;
            case "passwordreset":
                $this->_addToValidationErrorsIfUserDoesntExist( $email );
                if ( 
                    $this->_checkIfValidAppTokenEmail( $type )
                    && $this->_hasNoValidationErrors() 
                    && isset( $this->_request->getBody()["recaptchaToken"] )
                    && $this->verifyRecaptchaResponse( $this->_request->getBody()["recaptchaToken"] )
                ) {
                    $user    = new User( $email );
                    $success = $emailsService->sendPasswordResetEmail( $user );
                }
                if ( $success ) 
                    $this->_response = new JsonResponse( 200, ["password reset link sent to ".$email], true );
                break;
            case "contactform":
                if ( 
                    !isset( $this->_request->getBody()["msg"] )
                    || $this->sanitizeStringInput( $this->_request->getBody()["msg"] ) == ""
                )
                    $this->_addValidationError( "Message", "You need to fill in all fields correctly!" );
                if (  
                    isset( $this->_request->getBody()["recaptchaToken"] )
                    && $this->verifyRecaptchaResponse( $this->_request->getBody()["recaptchaToken"] )
                    && $this->_hasNoValidationErrors()
                ) {
                    // logging the contact form to file case something goes wrong with emailing it
                    $logger = LoggerService::getInstance();
                    $logger->log( "info", "CONTACT FORM SENT BY ".$email );
                    $logger->log( "info", "CONTACT FORM MESSAGE => ".$this->_request->getBody()["msg"] );
                    $success = $emailsService->sendContactFormEmailToAdmin(
                        $email,
                        $this->_request->getBody()["msg"]
                    );
                    if ( $success ) 
                    $this->_response = new JsonResponse( 
                        200, 
                        ["Message has been sent successfully and will be responded to within 24 hours."], 
                        true 
                    );
                }
                break;
        }
        return $success;
    }

    private function _performEmailsEndpointCommonValidationRounds( string $email ) : void {
        if ( !$this->validateEmail( $email ) ) $this->_addValidationError( "Email", "Invalid email format!" );
    }

    protected function _initResponse() : void {
        $logger = LoggerService::getInstance();
        $logger->log( "info", "RESPONSE FROM EMAILS CONTROLLER" );
        // pessimistic assumption
        $success = false;
        if ( $this->_request->isValid() && $this->_request->getMethod() == "POST" ) {
            // every POST request to the /emails endpoint has an email and a type field
            $email = isset( $this->_request->getBody()["email"] ) ? $this->_request->getBody()["email"] : "";
            $type  = isset( $this->_request->getBody()["type"] ) ? $this->_request->getBody()["type"] : "";
            $this->_performEmailsEndpointCommonValidationRounds( $email );
            if ( $this->_hasNoValidationErrors() )
                $success = $this->_performEmailingOperation( $email, $type );
        }
        if ( $success == false ) $this->_response = new JsonResponse( 200, ["validation errors" => $this->getValidationErrors()], false );
    } // EO _initResponse( method

} // EO class