<?php

namespace App\Controllers\Resources;

use App\Controllers\Resources\ResourcesController;

use App\Helpers\StringsTrait;

use App\Http\Requests\Request;
use App\Http\Responses\Json\JsonResponse;

use App\Models\User;

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
        $failed                 = true;
        $payload                = count( $this->_request->getBody() ) > 0 ? $this->_request->getBody() : [];
        $payloadMandatoryFields = ["username", "password", "confirmPassword", "email", "gender", "recaptchaToken"]; 
        $user = new User( null );
        // validation rounds conditioning the registration of the user
        if ( 
            count( $payload ) > 0
            && $this->_matchKeyValuePairs( $payloadMandatoryFields ) 
            && $this->verifyRecaptchaResponse( $payload["recaptchaToken"] ) 
            && $this->validateMatch( 
                $this->sanitizeStringInput( $payload["password"] ), 
                $this->sanitizeStringInput( $payload["confirmPassword"] )
            )
            && $user->validatePassword( $payload["password"] )
            && $user->validateUserEmail( $payload["email"] ) 
            && $user->validateUsername( $payload["username"] )
            && $user->validateGender( $payload["gender"] )
        ) {
            if ( $user->signUp( $payload ) ) {
                $failed = false;
                $this->_response = new JsonResponse( 200, ["You have signed up successfully!"], true, $user->read() );
            }
        } 
        if ( $failed != false ) $this->_response = new JsonResponse( 200, ["user registration failed"], false );
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

}