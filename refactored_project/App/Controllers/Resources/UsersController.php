<?php

namespace App\Controllers\Resources;

use App\Controllers\Resources\ResourcesController;

use App\Helpers\StringsTrait;

use App\Http\Requests\Request;
use App\Http\Responses\Json\JsonResponse;
use App\Models\AppToken;
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
        // pessimistic assumption
        $succeeded              = false;
        $payload                = count( $this->_request->getBody() ) > 0 ? $this->_request->getBody() : [];
        $payloadMandatoryFields = ["username", "password", "confirmPassword", "email", "gender", "recaptchaToken"]; 
        $user = new User( null );
        if ( 
            count( $payload ) > 0
            && $this->_matchKeyValuePairs( $payloadMandatoryFields ) 
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
            // sending the account verification link email
            $token  = ( new AppToken() )->create( $user->getId(), "accountVerification" );
            $mailContents = "
                <html>
                    <body>
                        <h2>Your login details for Top Mafia!</h2>
                        <p>Your username is "
                            ."<strong>".$user->username."</strong>"
                        ."</p>
                        <p>Email verification code <strong> ".$token."</strong></p>"
                        ."<p>"
                            ."- head back to <a href='.".$_ENV["APP_URL"]."/apptokens?token=".$token."&type=accountverification".".'>Top Mafia</a>"
                        ."</p>
                    </body>
                </html> 
            ";
            // sending the password reset email
            $this->sendEmailAndSetResponse( 
                $_ENV["MAIL_FROM_NAME"] , 
                "Verify your Top Mafia account!", 
                $user->getEmail(),
                $mailContents,
                "Please verify your account",
                "There was an issue during the registration process. Please try again later to validate your account." 
            );
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
        $this->_setUnauthorizedResponse();
    }

}