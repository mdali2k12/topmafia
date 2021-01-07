<?php

namespace App\Controllers\Resources;

use App\Controllers\Resources\ResourcesController;
use App\Helpers\ArraysTrait;
use App\Http\Requests\Request;
use App\Http\Responses\Json\JsonResponse;
use App\Models\User;
use App\Validators\RecaptchaValidator;

class UsersController extends ResourcesController {

    use ArraysTrait;
    use RecaptchaValidator;

    public function __construct( Request $request )
    {
        parent::__construct( $request );
    }

    protected function _initCreateOneResponse(): void {
        $payload                = isset( $_POST["userPayload"] )? json_decode( $_POST["userPayload"], true ) : [];
        $payloadMandatoryFields = ["username", "password", "confirmPassword", "email", "gender", "recaptchaToken"]; 
        if ( 
            $this->_matchKeyValuePairs( $payloadMandatoryFields ) 
            && $this->verifyRecaptchaResponse( $payload["recaptchaToken"] ) 
        ) {
            // TODO validate and then create the user
        }
    }

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