<?php

namespace App\Models;

use App\Database\SessionDAO;

class Session {

    private int        $_id     = 0; // id 0 means session model has not been hydrated
    private int        $_userId;
    private string     $_accessToken = "";
    private string     $_accessTokenExpiry;
    private string     $_refreshToken;
    private string     $_refreshTokenExpiry;
    private SessionDAO  $_sessionDAO;

    public function __construct( int $id = 0 ) {
        $this->_sessionDAO = new SessionDAO();
        if ( $id > 0 ) $this->_init( $id );
    }

    private function _inflate( array $fetched ) : void {
        if ( $fetched["rowCount"] > 0 ) {
            $this->_id                 = $fetched["id"];
            $this->_userId             = $fetched["userId"];
            $this->_accessToken        = $fetched["accessToken"];
            $this->_accessTokenExpiry  = $fetched["accessTokenExpiry"];
            $this->_refreshToken       = $fetched["refreshToken"];
            $this->_refreshTokenExpiry = $fetched["refreshTokenExpiry"];
        }
    }

    private function _init( int $id ) {
        $fetched = $this->_sessionDAO->get( $id );
        $this->_inflate( $fetched );
    }

    private function _initWithUserId( int $id ) {
        $fetched = $this->_sessionDAO->findByUserId( $id );
        $this->_inflate( $fetched );
    }

    public function create( int $userId ) : bool {
        $this->_sessionDAO->create( $userId);
        $this->_initWithUserId( $userId );
        return $this->_id != 0;
    }

    public function deleteAllOtherUserSessions() {
        $this->_sessionDAO->deleteAllOtherUserSessions( $this->_id, $this->_userId );
    }

    public function refreshAccessToken() : bool {
        $newExpiry                = $this->_sessionDAO->incrementDateTimeWithSeconds( $_ENV["ACCESS_TOKEN_EXPIRY"] );
        $this->_accessTokenExpiry = $newExpiry;
        return $this->_sessionDAO->refreshAccessToken( $this->_id, $newExpiry );
    }

    public function read() : array {
        return [
            "id"                 => $this->_id,
            "userId"             => isset( $this->_userId ) ? $this->_userId : null, 
            "accessToken"        => $this->_accessToken,
            "accessTokenExpiry"  => isset( $this->_accessTokenExpiry ) ?  $this->_accessTokenExpiry : null,  
            "refreshToken"       => isset( $this->_refreshToken ) ? $this->_refreshToken : null,
            "refreshTokenExpiry" => isset( $this->_refreshTokenExpiry )? $this->_refreshTokenExpiry : null
        ];
    }

}