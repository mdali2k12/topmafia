<?php

namespace App\Http\Requests;

use App\Http\Requests\Request as Request;

class GetRequest extends Request {

    public array  $_queryStrings  = [];

    public function __construct() {
        parent::__construct();
        $this->_setQueryStrings();
    } 

    // @Override
    public function isValid() : bool {
        return $this->_userAgentIsValid() && $this->_ipAddressIsValid() && $this->_urlIsValid();
    }

    // SO setters/getters
    public function getQueryStrings() : array {
        return $this->_queryStrings;
    }
    private function _setQueryStrings() : void {
        $sanitizedQueryStringsArr = [];
        foreach ( $_GET as $key => $value ) {
            if (
                $this->sanitizeStringInput( $this->removeSpaces( $key ) ) != "" 
                && $this->sanitizeStringInput( $this->removeSpaces( $value ) ) != false 
                && $this->sanitizeStringInput( urldecode( $key ) ) != null
                && $this->sanitizeStringInput( urldecode( $value ) ) != false
            ) {
                $sanitizedQueryStringsArr[$key] = $value;
            }
        }
        $this->_queryStrings = $sanitizedQueryStringsArr;
    }
    // EO setters/getters

} // EO class