<?php

namespace App\Models;

use App\Database\SessionDAO;

class Session {

    private string     $_accessToken = "";
    private string     $_accessTokenExpiry;
    private int        $_id = 0; // id 0 means session model has not been hydrated
    private string     $_ipAddress;
    private string     $_userAgent;
    private string     $_refreshToken;
    private string     $_refreshTokenExpiry;
    private SessionDAO $_sessionDAO;
    private int        $_userId;

    public function __construct( int $id = 0 ) { // id set to 0 means empty model
        $this->_sessionDAO = new SessionDAO();
        if ( $id > 0 ) $this->_inflate( $id );
    }

    private function _destroyUserSessions( int $userId ) {
        $this->_sessionDAO->destroyUserSessions( $userId );
    }

    // hydrating the model
    private function _inflate( int $id ) : void {
        $fetched = $this->_sessionDAO->get( $id );
        if ( $fetched["rowCount"] > 0 ) {
            $this->_accessToken        = $fetched["accessToken"];
            $this->_accessTokenExpiry  = $fetched["accessTokenExpiry"];
            $this->_id                 = $fetched["id"];
            $this->_ipAddress          = $fetched["ip"];
            $this->_refreshToken       = $fetched["refreshToken"];
            $this->_refreshTokenExpiry = $fetched["refreshTokenExpiry"];
            $this->_userAgent          = $fetched["userAgent"];
            $this->_userId             = $fetched["userId"];
        }
    }

    /**
     * 
     * on creating a new session,
     * we destroy all other user-linked sessions;
     * it's because it's part of the business logic that 
     * user can be logged in on only one device
     * 
     */
    public function create( int $userId, string $ipAddress, string $userAgent ) : bool {
        $this->_destroyUserSessions( $userId );
        $this->_sessionDAO->create( $userId, $ipAddress, $userAgent );
        $this->_inflate( $userId );
        return $this->_id != 0;
    }

    public function dateIsExpired( string $tokenType ) : bool {
        switch ($tokenType) {
            case 'accessToken':
                return $this->_sessionDAO->dateIsExpired( $this->_accessTokenExpiry );
                break;
            case 'refreshToken':
                return $this->_sessionDAO->dateIsExpired( $this->_refreshTokenExpiry );
                break;            
            default:
                return true;
        }
    }

    public static function exists( int $id ): bool {
        $sessionDAO = new SessionDAO();
        return $sessionDAO->exists($id );
    }

    public function getId() : int {
        return $this->_id;
    }

    public function refreshAccessToken() : bool {
        $newExpiry                = $this->_sessionDAO->incrementDateTimeWithSeconds( $_ENV["ACCESS_TOKEN_EXPIRY"] );
        $this->_accessTokenExpiry = $newExpiry;
        return $this->_sessionDAO->refreshAccessToken( $this->_id, $newExpiry );
    }

    public function read() : array {
        return [
            "id"                 => $this->_id,
            "userId"             => $this->_userId, 
            "accessToken"        => $this->_accessToken,
            "accessTokenExpiry"  => $this->_accessTokenExpiry,  
            "refreshToken"       => $this->_refreshToken,
            "refreshTokenExpiry" => $this->_refreshTokenExpiry
        ];
    }

}