<?php

namespace App\Models;

use App\Database\AppTokenDAO;

use App\Helpers\StringsTrait;

class AppToken {

    use StringsTrait;

    private AppTokenDAO $_atdao;

    public function __construct() {
        $this->_atdao = new AppTokenDAO();
    }

    // the provided type must be one of the types present in the corresponding field enum in db
    public function create( int $userId, string $type ) : string {

        // we create the token and get rid of equal signs in it since it can lead to query string parsing errors
        $randomChar = $this->generateRandomChar();
        while ( $randomChar == '=' )
            $randomChar = $this->generateRandomChar();
        $token = str_replace( "=", $randomChar, $this->buildToken() );

        $this->_atdao->create( $userId, $type, $token );
        return $token;
    }

}