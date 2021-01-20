<?php

namespace App\Http\Requests;

use App\Helpers\StringsTrait as StringsTrait;

use App\Validators\NumbersValidator;

trait JsonPayloadTrait {

    use NumbersValidator;
    use StringsTrait;

    protected array  $_body              = [];
    protected bool   $_validJsonAttached = false;

    protected function _initBody() {
        $this->_setBody();
        $this->_setValidJsonAttached();
    }

    protected function _setBody() : void {
        $rawData       = file_get_contents( 'php://input' );
        $processedData = json_decode( $rawData, true );
        if ( !is_null( $processedData ) && $processedData != false )
            foreach ( $processedData as $key => $value ) {
                if ( 
                    !is_null( $key )
                    && gettype( $key ) === "string"
                    && $this->sanitizeStringInput( $key ) != "" 
                    && !is_null( $value )
                    // values sent in payloads can be string or int
                    && ( 
                        ( gettype( $value ) === "string"  && $this->sanitizeStringInput( $value ) != "" )
                        ||
                        (
                            ( gettype( $value ) === "integer" || gettype( $value ) === "double" )
                            && $this->validateNumber( $value )
                        ) 
                    )
                )
                    $this->_body[$key] = $value;
            }
    } // EO _setBody(

    protected function _setValidJsonAttached() : void {
        if ( 
            ( isset( $_SERVER["CONTENT_TYPE"] ) && $_SERVER["CONTENT_TYPE"] == "application/json" )
            &&
            ( 
                isset( $this->_headers["Content-Type"] ) && $this->_headers["Content-Type"] == "application/json"  
                ||
                isset( $this->_headers["content-type"] ) && $this->_headers["content-type"] == "application/json"  
            )
            &&
            count( $this->_body ) > 0
        )
            $this->_validJsonAttached = true;
    } // EO _setValidJsonAttached(

    public function getBody() {
        return $this->_body;
    }

    public function hasValidJsonAttached() : bool {
        return $this->_validJsonAttached;
    }

} // EO RequestWithBodyTrait