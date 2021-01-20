<?php

namespace App\Validators;

use App\Helpers\StringsTrait;

trait ArraysValidator {

    use StringsTrait;

    public function matchPayloadKeys( array $fields, array $payload ) : bool {
        $go = ( count( $payload ) === count( $fields ) );
        if ( $go != false )
            foreach( $payload as $key => $value ) {
                if ( 
                    !in_array( $key, $fields ) 
                    ||
                    $this->sanitizeStringInput( $key ) == ""
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