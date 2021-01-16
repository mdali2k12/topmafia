<?php

namespace App\Controllers\Resources;

use App\Http\Responses\Json\JsonResponse;

use App\Models\AppToken;
use App\Models\Session;
use App\Models\User;

use App\Services\LoggerService;

class AppTokensController extends ResourcesController {


    protected function _initCreateOneResponse(): void{
        $this->_setUnauthorizedResponse();
    }
    protected function _initReadAllResponse(): void {
        // pessimistic assumption
        $success = false;
        // validating that request to app' tokens contains valid query strings (type and token)
        if (
            count( $this->_request->getQueryStrings() ) == 2 // 2 because "type" and "token"
            && isset( $this->_request->getQueryStrings()["type"] )
            && isset( $this->_request->getQueryStrings()["token"] )
            // no need for further validation regarding query strings because it already happened in the GetRequest object
            && $this->_request->getIpAddress() != ""
            && $this->_request->getUserAgent() != ""
            // ip address and user agent are needed to create session to send back is success
        ){
            $type          = $this->_request->getQueryStrings()["type"];
            $token         = $this->_request->getQueryStrings()["token"];
            $appTokenModel = new AppToken();
            $success       = $appTokenModel->matchTypeAndToken( $type,$token );
            $user          = new User( $token );
            $session       = new Session();
            // LoggerService::getInstance()->log( "info", "MATCH APP TOKEN OUTCOME => ".$success ?? "OK" );
            if( $user->isVerified() )
                $this->_response = new JsonResponse( 200, ["account already verified"], false );
            elseif ( 
                $success != false 
                && $user->getId() != 0 
                && $session->create( $user->getId(), $this->_request->getIpAddress(), $this->_request->getUserAgent() ) 
            ) {
                $success = $appTokenModel->consume( "accountverification", $token, $user );
                if ( $success != false ) 
                    $this->_response = new JsonResponse( 200, ["account verified"], true, [
                        "user"    => $user->read(),
                        "session" => $session->read()
                    ]);
            } 
        };
        if ( $success == false ) $this->_response = new JsonResponse( 200, ["account verification failed"], false );
    }
    protected function _initReadOneResponse(): void{
        $this->_setUnauthorizedResponse();
    }
    protected function _initUpdateOneResponse(): void
    {
        $this->_setUnauthorizedResponse();
    }

}