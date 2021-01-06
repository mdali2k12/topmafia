<?php

namespace App\Http\Requests;

use App\Http\Requests\Request          as Request;
use App\Http\Requests\JsonPayloadTrait as JsonPayloadTrait;

// TODO log headers and payload when POST and necessary
class PostRequest extends Request {

    use JsonPayloadTrait;

    public function __construct() {
        parent::__construct();
        $this->_initBody();
    } 

    // @Override
    public function isValid() : bool {
        return  $this->_urlIsValid() && $this->getMethod() == "POST";
    }

} // EO class