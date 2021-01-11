<?php

namespace App\Validators;

use App\Database\SessionDAO;

use App\Models\User;
use App\Models\Session;

use App\Helpers\StringsTrait;

trait AuthValidator {

    use StringsTrait;

    public function authHeaderIsNotNullish() : bool {
        $providedToken = $this->sanitizeStringInput( $this->removeSpaces( $_SERVER['HTTP_AUTHORIZATION'] ) );
        return $providedToken != "" && $providedToken != false;
    }

    public function authHeaderIsProvided() : bool {
        return isset( $_SERVER['HTTP_AUTHORIZATION'] ) && strlen( $_SERVER['HTTP_AUTHORIZATION'] ) > 0;
    }

    public function getProvidedAccessToken() : string {
        return $this->sanitizeStringInput( $this->removeSpaces( $_SERVER['HTTP_AUTHORIZATION'] ) );
    }

    public function tokenIsExpired( int $sessionId, string $tokenType ) : bool {
        $session    = new Session( $sessionId );
        if ( $session->getId() > 0 )
            return $session->dateIsExpired( $tokenType );
        return false;
    }

    public function validateUserPassword( string $inputPassword, $userIdentifier ) : bool {
        $user       = new User( $userIdentifier );
        $inputHash  = $this->appHash( $this->sanitizeStringInput( $inputPassword ) );
        $sourceHash = $user->getHashedPassword();
        return $inputHash === $sourceHash;
    }

    public function validateTokenAndSessionIdAssociation( string $token, int $sessionId ) : bool {
        $sessionDao = new SessionDAO();
        return $sessionDao->tokenIdAssociationIsValid( $token, $sessionId );
    }

    public function validateTokensAndId( string $accessToken, string $refreshToken, int $sessionId ) : bool {
        $sessionDao = new SessionDAO();
        return $sessionDao->tokensIdAssociationIsValid( $accessToken, $refreshToken, $sessionId  );
    }

    public function validateTokenUserAssociation( int $sessionId, int $userId, string $accessToken ) : bool {
        $sessionDao = new SessionDAO();
        return $sessionDao->tokenUserAssociationIsValid( $sessionId, $userId, $accessToken );
    }

} // EO class