<?php

namespace App\Validators;

use App\Helpers\StringsTrait;

trait StringsValidator {

    use StringsTrait;

    protected function validateAlphaNumeric( string $input ) {
        return preg_match( '/^[\p{L}\p{N}]+$/', $this->sanitizeStringInput( $input ) );
    }

    protected function validateEmail( string $input ): bool {
        if( 
            !filter_var( $input, FILTER_VALIDATE_EMAIL ) 
            || 
            !\checkdnsrr( $this->getDNSFromEmail( $input ), "MX" ) 
        )
            return false;
        return true;
    }

    protected function validateHashesMatch(
        string $source, 
        string $target, 
        string $algo
    ) : bool {
        return $source === hash( $algo, $target );
    }

    protected function validateMatch( string $val1, string $val2 ) : bool {
        if ( 
            $this->sanitizeStringInput( $val1 ) != ""
            && $this->sanitizeStringInput( $val2 ) != ""
            && $this->sanitizeStringInput( $val1 ) === $this->sanitizeStringInput( $val2 ) 
        )
            return true;
        return false;
    }

    protected function validateStringInputLength( 
        string $input,
        int    $min, 
        int    $max 
    ): bool {
        if ( 
            strlen( $this->sanitizeStringInput( $input ) ) >= $min 
            && strlen( $this->sanitizeStringInput( $input ) ) <= $max 
        )
            return true;
        return false;
    }

} // EO class