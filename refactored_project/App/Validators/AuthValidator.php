<?php

namespace App\Validators;

use App\Database\SessionDAO;

use App\Models\Session;

use App\Helpers\StringsTrait;

trait AuthValidator {

    use StringsTrait;

    public function accessTokenIsExpired( int $sessionId ) : bool {
        $sessionDao = new SessionDAO();
        $session    = new Session( $sessionId );
        return $sessionDao->dateIsExpired( $session->read()["accessTokenExpiry"] );
    }

    public function authHeaderIsNotNullish() : bool {
        $providedToken = $this->sanitizeStringInput( $this->removeSpaces( $_SERVER['HTTP_AUTHORIZATION'] ) );
        return $providedToken != "" && $providedToken != false;
    }

    public function authHeaderIsProvided() : bool {
        return isset( $_SERVER['HTTP_AUTHORIZATION'] ) && strlen( $_SERVER['HTTP_AUTHORIZATION'] ) > 0;
    }

    public function refreshTokenIsExpired( array $session ) : bool {
        $sessionDao = new SessionDAO();
        return $sessionDao->dateIsExpired( $session["refreshTokenExpiry"] );
    }

    public function validateTokenUserAssociation( int $sessionId, int $userId ) : bool {
        $sessionDao = new SessionDAO();
        return $sessionDao->exists( $sessionId, $userId );
    }

} // EO class