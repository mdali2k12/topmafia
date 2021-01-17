<?php

namespace App\Validators;

use App\Helpers\StringsTrait;

trait ArraysValidator {

    use StringsTrait;

    public function matchKeyValuePairs( array $fields, $specificPayload = null ) : bool {
        $go = ( count( $this->_request->getBody() ) === count( $fields ) ) && is_null( $specificPayload );
        if ( $go != false ) {
            $arrToIterateOn = $this->_request->getBody();
        } 
        if ( !is_null( $specificPayload ) ) {
            $arrToIterateOn = $specificPayload;
            $go             = true;
        }
        if ( $go != false )
            foreach( $arrToIterateOn as $key => $value ) {
                if ( 
                    !in_array( $key, $fields ) 
                    ||
                    $this->sanitizeStringInput( $value ) == ""
                )
                    $go = false;
            }
        return $go;
    }

    public function matchUpdatableFields( array $updatableFields ) : bool {
        $go = true;
        $fieldsToIterateOn = array_filter( $this->_request->getBody(), function( $key ) {
            return $key != "confirmPassword" && $key != "recaptchaToken" && $key != "tokenType" && $key != "appToken";
        }, ARRAY_FILTER_USE_KEY);
        if ( count( $fieldsToIterateOn ) > 0 ) {
            foreach( $fieldsToIterateOn as $key => $value ) {
                if ( 
                    !in_array( $this->sanitizeStringInput( $key ), $updatableFields ) 
                    ||
                    $this->sanitizeStringInput( $value ) == ""
                )
                    $go = false;
            }
        } else
            $go = false;
        return $go;
    }

} // EO class