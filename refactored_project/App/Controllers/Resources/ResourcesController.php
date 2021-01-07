<?php

namespace App\Controllers\Resources;

use App\Controllers\Controller;
use App\Http\Requests\Request;

abstract class ResourcesController extends Controller {

    public function __construct( Request $request )
    {
        parent::__construct( $request );
    }

    abstract protected function _initCreateOneResponse(): void;
    abstract protected function _initReadAllResponse(): void;
    abstract protected function _initReadOneResponse(): void;

    protected function _initResponse() : void {
        switch( $this->_request->getMethod() ) {
            case "GET":
                !$this->_request->hasIdentifier() ? $this->_initReadAllResponse() : 
                    $this->_initReadOneResponse();
                break;
            case "POST":
                !$this->_request->hasIdentifier() ? $this->_initCreateOneResponse() : 
                    $this->_setBadRequestResponse();
                break;
            default:
                $this->_setMethodNotAllowedResponse();
                break;
        }
    }

}