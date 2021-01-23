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
use App\Validators\NumbersValidator;
use App\Validators\RecaptchaValidator;
use App\Validators\StringsValidator;

class UsersController extends ResourcesController {

    use ArraysValidator;
    use NumbersValidator;
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
        $payloadTmp             = count( $this->_request->getBody() ) > 0 ? $this->_request->getBody() : [];
        $payload                = array_filter( $payloadTmp, function( $key ) {
            return $key != "sponsorId";
        }, ARRAY_FILTER_USE_KEY );
        $payloadMandatoryFields = ["username", "password", "confirmPassword", "email", "gender", "recaptchaToken"]; 
        $user                   = new User( null );
        // first set of validation rounds
        if ( 
            count( $payload ) > 0
            && $this->matchPayloadKeys( $payloadMandatoryFields, $payload ) 
        ) {

            // second set of validation rounds
            foreach ( ["username", "email"] as $field ) {
                $succeeded = $this->sanitizeStringInput( $payload[$field] ) != "";
            }

            // third set of validation rounds aimed at filling the validation errors array for user feedback
            if ( $succeeded ) {
                if ( !$this->validateEmail( $payload["email"] ) ) 
                    $this->_addValidationError( "Email", "Invalid E-mail address" );
                if ( !$user->validateUserEmailIsNotBanned( $payload["email"] )  ) 
                    $this->_addValidationError( "Email", "Your email has been banned" );
                if ( !$user->validateUserEmail( $payload["email"] )  ) 
                    $this->_addValidationError( "Email", "The E-mail you entered is in use." );
                if ( !$user->validateUsernameLength( $payload["username"] ) )
                    $this->_addValidationError( "Username", "Sorry the Username must be between 6 and 15 characters inclusive." );
                if ( !$this->validateAlphaNumeric( $payload["username"] ) )
                    $this->_addValidationError( "Username", "You entered invalid characters in your username Keep it simple." );
                if ( !$user->validateUsername( $payload["username"] ) )
                    $this->_addValidationError( "Username", "The Username you entered is in use." );
                if ( !$this->validateAlphaNumeric( $payload["password"] ) )
                    $this->_addValidationError( "Password", "You entered invalid characters in your password." );
                if ( !$this->validateMatch( $this->sanitizeStringInput( $payload["password"] ), $this->sanitizeStringInput( $payload["confirmPassword"] )))
                    $this->_addValidationError( "Password", "Your passwords do not match." );
                if ( !$this->verifyRecaptchaResponse( $payload["recaptchaToken"] ) )
                    $this->_addValidationError( "Recaptcha", "Google says you're a robot 🤖" );
                if ( isset( $this->_request->getBody()["sponsorId"] ) )
                    $this->_validateSponsorship();
                $succeeded = $this->_hasNoValidationErrors();
            }

            // we proceed with persisting the user in db only if there are no validation errors
            if ( $succeeded )
                $succeeded = $user->signUp( $payload ); // the outcome of the operation depends on successul execution of model signUp method

            if ( $succeeded && isset( $this->_request->getBody()["sponsorId"] ) ) {
                // if that procedure fails, user is deleted
                $succeeded = $user->undergoesSponsorshipRequestProcedure( 
                    $this->_request->getBody()["sponsorId"],
                    $this->_request->getIpAddress(),
                    $this->_request->getUserAgent()
                );
                if ( !$succeeded ) 
                    $this->_addValidationError(
                        "Sponsorship",
                        "Are you trying to cheat the game by referring yourself? If we find out, your IP will be banned!"
                    );
            }

            if ( $succeeded != false ) {
                $this->_response = new JsonResponse( 200, ["You have signed up successfully!"], true, $user->read() );
                $emailsService   = new EmailsService();
                $emailsService->sendAccountVerificationEmail( $user );
            }  

        } 
        // if failure, we send the validation errors array back for user feedback
        if ( !$succeeded ) $this->_response = new JsonResponse( 200, ["user registration failed"], false, ["validation errors" => $this->getValidationErrors()] ); 
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
            && $this->validateNumber( $this->_request->getIdentifier() )
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

    private function _validateSponsorship() : void {
        if ( 
            $this->validateNumber( $this->_request->getBody()["sponsorId"] )
        ) {
            if ( !User::exists( $this->_request->getBody()["sponsorId"] ) )
                $this->_addValidationError( "Sponsor", "The sponsorship ID doesnt exist" );
        } else $this->_addValidationError( "Sponsor", "Something is wrong with the sponsor ID you provided" );
    }

}