<?php

namespace App\Models;

use App\Database\AppTokenDAO;

use App\Helpers\StringsTrait;

use App\Services\LoggerService;

class AppToken {

    use StringsTrait;

    private AppTokenDAO $_atdao;

    public function __construct() {
        $this->_atdao = new AppTokenDAO();
    }

    public function consume( string $type, string $token, User $user ): bool {
        LoggerService::getInstance()->log( "info", "SO APP TOKEN PROCESSING" );
        LoggerService::getInstance()->log( "info", "TOKEN => ".$token );
        switch ( $type ) {
            case "accountverification":
                return $user->verifyAccount() && $this->_atdao->updateVerifiedAt( $token );
            // TODO password reset flow
        }
        return false;
    }

    public function create( int $userId, string $type ) : string {
        // the provided type must be one of the types present in the corresponding field enum in db
        $allowedTokenTypes = explode( ',', $_ENV["ALLOWED_APP_TOKENS"] );
        if ( in_array( $type, $allowedTokenTypes ) ) {
            // we create the token and get rid of equal signs in it since it can lead to query string parsing errors
            $randomChar = $this->generateRandomChar();
            while ( $randomChar == '=' )
                $randomChar = $this->generateRandomChar();
            $token = str_replace( "=", $randomChar, $this->buildToken() );
            $this->_atdao->create( $userId, $type, $token );
            return $token;
        }
        return "";
    }

    public function matchTypeAndToken( string $type, string $token ): bool {
        return $this->_atdao->matchTypeAndToken( $type, $token );
    }

}