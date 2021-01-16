<?php

namespace App\Controllers;

use App\Helpers\StringsTrait; 

use App\Http\Requests\Request;
use App\Http\Requests\PostRequest;

use App\Models\User;

use App\Services\EmailsService;
use App\Services\LoggerService;

use App\Validators\ArraysValidator;

class EmailsController extends Controller {

    use ArraysValidator;
    use StringsTrait;

    public function __construct( Request $request ) {
        parent::__construct( $request );
    }

    protected function _initResponse() : void {
        LoggerService::getInstance()->log( "info", "RESPONSE FROM EMAILS CONTROLLER" );
        switch( $this->_request->getMethod() ) {
            case "POST":
                LoggerService::getInstance()->log( "info", "SENDING ACCOUNT VERIFICATION EMAIL" );
                $payload                = count( $this->_request->getBody() ) > 0 ? $this->_request->getBody() : [];
                $payloadMandatoryFields = ["email", "type"]; 
                if ( 
                    $this->_request->isValid() 
                    && $this->_matchKeyValuePairs( $payloadMandatoryFields ) 
                    && isset( $this->_request->getBody()["email"] )
                    && $this->sanitizeStringInput( $this->_request->getBody()["email"] ) != ""
                    && isset( $this->_request->getBody()["type"] )
                    && $this->sanitizeStringInput( $this->_request->getBody()["type"] ) != ""
                    && User::exists( $this->_request->getBody()["email"] )
                    && $this->_request->getBody()["type"] == "accountverification"
                ) {
                    $emailsService = new EmailsService();
                    $user          = new User( $this->_request->getBody()["email"] );
                    $emailsService->sendAccountVerificationEmail( $user );
                } 
                break;
            default:
                $this->_setBadRequestResponse();
                break;
        }
    } 

} // EO class