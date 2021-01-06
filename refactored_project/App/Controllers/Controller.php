<?php

namespace App\Controllers;

use App\Http\Requests\Request            as Request;
use App\Http\Responses\Response          as Response;
use App\Http\Responses\Json\JsonResponse as JsonResponse;

abstract class Controller {

    protected array    $_mandatoryFields = [];
    protected Request  $_request;
    protected Response $_response;

    protected function __construct( Request $request ) {
        $this->_request = $request;
        $this->_request->isValid() ?  $this->_initResponse() : $this->_response =  new JsonResponse( 400, ["bad request"], false );
    }

    /**
     * 
     * @description
     * 
     * method in which controller gets all the necessary data to instanciate a response object
     * 
     */
    abstract protected function _initResponse() : void;

    protected function _setMandatoryFields( ...$els ) : void {
        foreach ( $els as $el ) {
            array_push( $this->_mandatoryFields, $el );
        }
    }

    protected function _setBadRequestResponse(): void {
        $this->_response = new JsonResponse( 400, ["request method not allowed"], false );
    }

    protected function _setMethodNotAllowedResponse(): void {
        $this->_response = new JsonResponse( 405, ["request method not allowed"], false );
    }

    protected function _setUnauthorizedResponse(): void {
        $this->_response = new JsonResponse( 401, ["unauthorized"], false );
    }

    protected function _setServerErrorResponse( string $message ): void {
        $this->_response = new JsonResponse( 500, [$message], false );
    }

    public function handleRequest() : Response {
        $response = null;
        !isset( $this->_response ) ? $response =  $this->_setBadRequestResponse() : $response = $this->_response;
        return $response;
    }

} // EO Controller class