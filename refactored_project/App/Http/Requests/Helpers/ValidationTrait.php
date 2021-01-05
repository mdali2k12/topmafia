<?php

namespace App\Helpers;

trait ValidationTrait {

    protected function validateEmail( string $input ): bool {
        if( 
            !filter_var( $input, FILTER_VALIDATE_EMAIL ) 
            || 
            !\checkdnsrr( $this->getDNSFromEmail( $input ), "MX" ) 
        )
            return false;
        return true;
    }
    
    protected function validateStringInputLength( 
        string $input,
        int    $min, 
        int    $max 
    ): bool {
        if ( strlen( $input ) >= $min && strlen( $input ) <= $max )
            return true;
        return false;
    }

}

