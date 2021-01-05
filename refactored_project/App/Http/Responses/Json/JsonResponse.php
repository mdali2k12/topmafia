<?php 

namespace App\Http\Responses\Json;

use App\Http\Responses\Response as Response;

class JsonResponse extends Response {

    private array  $_messages        = []; // an array of string response messages
    private        $_responsePayload = [];
    private bool   $_success;

    public function __construct( int $httpStatusCode, array $messages = [], bool $success, array $data = [] ) {
        parent::__construct( $httpStatusCode );
        $this->_messages           = $messages;
        $this->_success            = $success;
        $this->_responsePayload    = $data;
        $this->_contentTypeHeader .= "application/json;charset=utf-8";
    }

    // @Override from Response class
    public function _sendSpecific() : void {
        $this->_responsePayload["httpStatusCode"] = $this->getHttpStatusCode();
        $this->_responsePayload["success"]        = $this->_success;
        if ( count( $this->_messages ) > 0 )
            $this->_responsePayload["messages"] = $this->_messages;
        echo json_encode( $this->_responsePayload );
    }
    // EO overriding abstract parent class

} // EO class
