<?php

namespace App\Validators;

trait NumbersValidator {

    public function validateNumber( $id ) : bool {
        return ( 
            !is_null( $id )
            && $id != ""
            && $id !== false
            && is_numeric( $id )
            && floatval( intval( $id )) === floatval( $id )
        );
    }

}