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

    public function formatHumanNames( string $input ): string {
        $output = strtolower( $input );
        $output = ucfirst( $output );
        return $output;
    }

    public function generateRandomPassword() : string {
        $pw = '';
        $c  = 'bcdfghjklmnprstvwz'; //consonants except hard to speak ones
        $v  = 'aeiou'; //vowels
        $a  = $c . $v; //both
        //use two syllables...
        for ($i = 0; $i < 2; $i++) {
            $pw .= $c[rand(0, strlen($c) - 1)];
            $pw .= $v[rand(0, strlen($v) - 1)];
            $pw .= $a[rand(0, strlen($a) - 1)];
        }
        //... and add a nice number
        $pw .= rand(10, 99);
        $pw .= $c[rand(0, strlen($c) - 1)];
        $pw .= $v[rand(0, strlen($v) - 1)];
        $pw .= $a[rand(0, strlen($a) - 1)];
        return $pw;        
    }

    public function generateRandomChar() : string {
        return substr( 
            // input string is an md5-hashed timestamp
            md5( microtime() ), 
            /**
             * 
             * since md5( func. returns a 32-character hexadecimal number,
             * we select a random number within its length bounds
             * at index n of the input string
             * 
             */
            rand( 0, 31 ),  
            // we get a single char
            1
        );
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