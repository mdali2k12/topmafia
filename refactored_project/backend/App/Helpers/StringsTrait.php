<?php

namespace App\Helpers;

trait StringsTrait {

    // wrapper around hashing functionalities
    protected function appHash( string $input ) : string {
        return hash( $_ENV["HASH_ALGO"], $input );
    }

    protected function buildToken() : string {
        return base64_encode( bin2hex( \openssl_random_pseudo_bytes( 24 ) ).time() );
    }

    protected function checkMatch( string $val1, string $val2 ) : bool {
        return $val1 !== $val2;
    }

    protected function compareHashes(
        string $source, 
        string $target, 
        string $algo
    ) : bool {
        return $source === hash( $algo, $target );
    }

    public function formatHumanNames( string $input ): string {
        $output = strtolower( $input );
        $output = ucfirst( $output );
        return $output;
    }

    protected function getDNSFromEmail( string $emailAddress ) {
        $domain = explode( "@", $emailAddress )[1];
        return $domain;
    }

    protected function removeSpaces( $input ): string {
        $output = trim( str_replace( " ", "",  $input ) );
        return $output;
    }

    protected function sanitizeStringInput( string $input ): string {
        $output = "";
        if ( !is_null( $input ) ) 
            $output = filter_var( strip_tags( $input ), FILTER_SANITIZE_STRING );
        if ( !$output )
            $output = "";
        return $output;
    }

} // EO class