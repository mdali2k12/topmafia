<?php

namespace App\Controllers\Resources;

use App\Controllers\Resources\ResourcesController;

use App\Helpers\StringsTrait;

use App\Http\Requests\Request;
use App\Http\Responses\Json\JsonResponse;

use App\Models\AppToken;
use App\Models\User;

use App\Services\EmailsService;

use App\Validators\ArraysValidator;
use App\Validators\RecaptchaValidator;
use App\Validators\StringsValidator;

class UsersController extends ResourcesController {

    use ArraysValidator;
    use RecaptchaValidator;
    use StringsTrait;
    use StringsValidator;

    public function __construct( Request $request )
    {
        parent::__construct( $request );
    }

    protected function _initCreateOneResponse(): void {
        // pessimistic assumption
        $succeeded              = false;
        $payload                = count( $this->_request->getBody() ) > 0 ? $this->_request->getBody() : [];
        $payloadMandatoryFields = ["username", "password", "confirmPassword", "email", "gender", "recaptchaToken"]; 
        $user = new User( null );
        if ( 
            count( $payload ) > 0
            && $this->matchKeyValuePairs( $payloadMandatoryFields ) 
            && $this->verifyRecaptchaResponse( $payload["recaptchaToken"] ) 
            && $this->validateMatch( 
                    $this->sanitizeStringInput( $payload["password"] ), 
                    $this->sanitizeStringInput( $payload["confirmPassword"] 
                )
            )
        ) 
            $succeeded = $user->signUp( $payload ); // the outcome of the operation depends on successul execution of model signUp method
        if ( $succeeded ) {
            $this->_response = new JsonResponse( 200, ["You have signed up successfully!"], true, $user->read() );
            $emailsService   = new EmailsService();
            $emailsService->sendAccountVerificationEmail( $user );
        }  
        else $this->_response = new JsonResponse( 200, ["user registration failed"], false ); 
    } // EO _initCreateOneResponse() method

    protected function _initReadAllResponse(): void {
        $playersCount       = User::getPlayersCount();
        $onlinePlayersCount = User::getOnlinePlayersCount();
        $this->_response    = new JsonResponse( 
            200, 
            ["fetched players count", "fetched online players count"],
            true,
            [
                "playersCount"       => $playersCount,
                "onlinePlayersCount" => $onlinePlayersCount
            ]
        );
    }

    protected function _initReadOneResponse(): void {
        $this->_setUnauthorizedResponse();
    }

    protected function _initUpdateOneResponse(): void
    {
        // pessimistic assumption
        $success                = false;
        $payload                = count( $this->_request->getBody() ) > 0 ? $this->_request->getBody() : [];
        $payloadUpdatableFields = ["password"];
        // uncomment to debug
        // validation rounds
        if ( 
            count( $payload ) > 0
            && isset( $payload["confirmPassword"] )
            && $this->matchUpdatableFields( $payloadUpdatableFields )
            && $this->validateMatch( 
                $this->sanitizeStringInput( $payload["password"] ), 
                $this->sanitizeStringInput( $payload["confirmPassword"] )
            )
            && isset( $payload["recaptchaToken"] )
            && $this->verifyRecaptchaResponse( $payload["recaptchaToken"] ) 
            && $this->_request->hasValidIntIdentifier()
            && isset( $payload["tokenType"] )
            && isset( $payload["appToken"] )
            && $this->sanitizeStringInput( $payload["tokenType"] ) != ""
            && $this->sanitizeStringInput( $payload["appToken"] ) != ""
        ) {
            $type          = $payload["tokenType"];
            $token         = $payload["appToken"];
            $appTokenModel = new AppToken();
            $user          = new User( $token );
            $success       = 
                $user->getId() != 0 
                && $appTokenModel->matchTypeAndToken( $type,$token ) 
                && $user->updatePassword( $payload["password"] )
                && $appTokenModel->consume( "passwordreset", $token, $user );
            if ( $success != false )
                $this->_response = new JsonResponse( 200, ["Your password has been updated"], true);
        } 
        if ( $success == false ) $this->_setUnauthorizedResponse();
    }

}