<?php

namespace App\Database;

use App\Helpers\StringsTrait;

class SessionDAO extends DAO {

    use StringsTrait;

    public function __construct() {
       parent::__construct();
    }

    public function create( int $userId ) : int {
        $insertedId = 0;
        if ( !is_null( $this->_mdbd->getDBConn() ) ) {
            $sql = "
                INSERT INTO sessions( userId, accessToken, refreshToken, accessTokenExpiry, refreshTokenExpiry )
                VALUES( :userId, :accessToken, :refreshToken, :accessTokenExpiry, :refreshTokenExpiry )
            ";
            $query = $this->_mdbd->getDBConn()->prepare( $sql );
            $query->execute( [
                ":userId"             => $userId,
                ":accessToken"        => $this->buildToken(),
                ":refreshToken"       => $this->buildToken(),
                ":accessTokenExpiry"  => $this->incrementDateTimeWithSeconds( intval( $_ENV["ACCESS_TOKEN_EXPIRY"] ) ),
                ":refreshTokenExpiry" => $this->incrementDateTimeWithSeconds( intval( $_ENV["REFRESH_TOKEN_EXPIRY"] ) )   
            ] );
            $query->rowCount() === 1 ?? $insertedId = $this->_mdbd->getDBConn()->lastInsertId();
        }
        return $insertedId;
    }

    public function destroyUserSessions( int $userId ) : void {
        $sql = "
            DELETE FROM sessions WHERE userId = :userId
        ";
        $query = $this->_mdbd->getDBConn()->prepare( $sql );
        $query->execute( [":userId" => $userId] );
    }

    public function exists( int $id ): bool {
        $sql   = "
            SELECT COUNT(*) AS rowCount 
            FROM sessions 
            WHERE id = :id 
        ";
        $query = $this->_mdbd->getDBConn()->prepare( $sql );
        $query->execute( [":id" => $id] );
        $rowCount = intval( $query->fetch()["rowCount"] );
        return $rowCount > 0;
    }

    public function get( int $id ) : array {
        $sql    = "
            SELECT 
                id, 
                userId, 
                accessToken, 
                accessTokenExpiry, 
                refreshToken,
                refreshTokenExpiry,
                COUNT(*) AS rowCount 
            FROM sessions 
            WHERE 
                id = :id 
            OR
                userId = :userId
            ORDER BY createdAt DESC
            LIMIT 1
        ";
        $query = $this->_mdbd->getDBConn()->prepare( $sql );
        $query->execute( [":id" => $id, ":userId" => $id] );
        $result = $query->fetch(); 
        if ( !$result )
            $result = [];
        return $result;
    }

    public function refreshAccessToken( int $sessionId, string $newExpiry ): bool {
        $sql   = "UPDATE sessions SET accessTokenExpiry = :newExpiry WHERE id = :sessionId";
        $query = $this->_mdbd->getDBConn()->prepare( $sql );
        return ( 
            $query->execute( [
                ":newExpiry" => $newExpiry,
                ":sessionId" => $sessionId
            ]) 
            && $query->rowCount() === 1 
        );       
    }

    public function tokenIdAssociationIsValid( string $token, int $sessionId ) : bool {
        $sql   = "
            SELECT COUNT(*) AS rowCount 
            FROM sessions 
            WHERE id          = :id 
            AND   accessToken = :accessToken
            ORDER BY createdAt DESC
        ";
        $query = $this->_mdbd->getDBConn()->prepare( $sql );
        $query->execute( [":id" => $sessionId, ":accessToken" => $token] );
        $rowCount = intval( $query->fetch()["rowCount"] );
        return $rowCount > 0;
    }

    public function tokensIdAssociationIsValid( string $accessToken, string $refreshToken, int $sessionId ): bool {
        $sql   = "
            SELECT COUNT(*) AS rowCount 
            FROM sessions 
            WHERE id           = :sessionId 
            AND   accessToken  = :accessToken
            AND   refreshToken = :refreshToken
            ORDER BY createdAt DESC
        ";
        $query = $this->_mdbd->getDBConn()->prepare( $sql );
        $query->execute( [":sessionId" => $sessionId, ":accessToken" => $accessToken, ":refreshToken" => $refreshToken] );
        $rowCount = intval( $query->fetch()["rowCount"] );
        return $rowCount > 0;
    }

    public function tokenUserAssociationIsValid( int $id, int $userId, string $accessToken ): bool {
        $sql   = "
            SELECT COUNT(*) AS rowCount 
            FROM sessions 
            WHERE id          = :id 
            AND   userId      = :userId
            AND   accessToken = :accessToken
            ORDER BY createdAt DESC
        ";
        $query = $this->_mdbd->getDBConn()->prepare( $sql );
        $query->execute( [":id" => $id, ":userId" => $userId, ":accessToken" => $accessToken] );
        $rowCount = intval( $query->fetch()["rowCount"] );
        return $rowCount > 0;
    }

}