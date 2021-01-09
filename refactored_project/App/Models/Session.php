<?php

namespace App\Models;

use App\Database\SessionDAO;

class Session {

    private int    $_id     = 0; // id 0 means session model has not been hydrated
    private int    $_userId;
    private string $_accessToken = "";
    private string $_accessTokenExpiry;
    private string $_refreshToken;
    private string $_refreshTokenExpiry;

    public function __construct( int $id = 0 ) {
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
        $sessionDao = new SessionDAO();
        $fetched = $sessionDao->get( $id );
        $this->_inflate( $fetched );
    }

    private function _initWithUserId( int $id ) {
        $sessionDao = new SessionDAO();
        $fetched = $sessionDao->findByUserId( $id );
        $this->_inflate( $fetched );
    }

    public function create( int $userId ) : bool {
        $sessionDao = new SessionDAO();
        $sessionDao->create( $userId);
        $this->_initWithUserId( $userId );
        return $this->_id != 0;
    }

    // TODO 
    public function refresh() : bool {
        return false;
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