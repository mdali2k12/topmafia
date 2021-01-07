<?php

namespace App\Helpers;

use App\Helpers\StringsTrait;

trait ArraysTrait {

    use StringsTrait;

    public function _matchKeyValuePairs( array $fields, $specificPayload = null ) : bool {
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

    public function _matchUpdatableFields( array $updatableFields ) : bool {
        $go = true;
        if ( count( $this->_request->getBody() ) > 0 && count( $this->_request->getBody() ) <= count( $updatableFields ) ) {
            foreach( $this->_request->getBody() as $key => $value ) {
                if ( 
                    !in_array( $key, array_keys( $updatableFields ) ) 
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