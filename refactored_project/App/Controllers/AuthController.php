<?php

namespace App\Controllers;

use App\Http\Requests\Request;
use App\Http\Responses\Json\JsonResponse;
use App\Models\Session;
use App\Models\User;

use App\Validators\ArraysValidator;
use App\Validators\AuthValidator;

class AuthController extends Controller {

    use ArraysValidator;
    use AuthValidator;

    public function __construct( Request $request ) {
        parent::__construct( $request );
    }

    protected function _initResponse() : void {
        switch( $this->_request->getMethod() ) {
            case "POST":
                $payload                = count( $this->_request->getBody() ) > 0 ? $this->_request->getBody() : [];
                $payloadMandatoryFields = ["sessionId", "userId"];
                if ( 
                    $this->_request->isValid() 
                    && count( $payload ) > 0
                    && $this->_matchKeyValuePairs( $payloadMandatoryFields ) 
                    && $this->authHeaderIsProvided()
                    && $this->authHeaderIsNotNullish()
                    && User::exists( $payload["userId"] )
                    && $this->validateTokenUserAssociation( $payload["sessionId"], $payload["userId"] ) 
                ) {
                    $this->accessTokenIsExpired( $payload["sessionId"] ) ?
                        $this->_response = new JsonResponse( 200, ["Your session is expired!"], false ) :
                        $this->_response = new JsonResponse( 200, ["You are being logged in.."], true );
                } else $this->_setUnauthorizedResponse();
                break;
            default:
                $this->_setUnauthorizedResponse();
                break;
        }
    } 

} // EO class