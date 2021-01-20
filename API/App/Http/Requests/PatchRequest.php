<?php

namespace App\Http\Requests;

use App\Http\Requests\Request as Request;
use App\Http\Requests\JsonPayloadTrait as JsonPayloadTrait;

// TODO log headers and payload when PATCH and necessary
class PatchRequest extends Request {

    use JsonPayloadTrait;

    public function __construct() {
        parent::__construct();
        $this->_initBody();
    } 

    public function isValid() : bool {
        return $this->_userAgentIsValid() 
               && $this->_ipAddressIsValid() 
               && $this->_urlIsValid() 
               && $this->hasValidJsonAttached() 
               && $this->getMethod() == "PATCH";
    }

} // EO class