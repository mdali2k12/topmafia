<?php

namespace App\Database;

use App\Helpers\StringsTrait;

// TODO DRY
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

    public function deleteAllOtherUserSessions( int $sessionId, int $userId ) : void {
        $sql = "
            DELETE FROM sessions WHERE id != $sessionId AND userId = $userId
        ";
        $query = $this->_mdbd->getDBConn()->prepare( $sql );
        $query->execute();
    }

    public function exists( int $id, int $userId ): bool {
        $sql   = "
            SELECT COUNT(*) AS rowCount 
            FROM sessions 
            WHERE id     = :id 
            AND   userId = :userId
            ORDER BY createdAt DESC
        ";
        $query = $this->_mdbd->getDBConn()->prepare( $sql );
        $query->execute( [":id" => $id, ":userId" => $userId] );
        $rowCount = intval( $query->fetch()["rowCount"] );
        return $rowCount > 0;
    }

    public function findByUserId( int $userId ) : array {
        $sql = "
            SELECT 
                id, 
                userId, 
                accessToken, 
                accessTokenExpiry, 
                refreshToken,
                refreshTokenExpiry,
                COUNT(*) AS rowCount 
            FROM sessions 
            WHERE userId = :userId 
            ORDER BY createdAt DESC
            LIMIT 1
        ";
        $query = $this->_mdbd->getDBConn()->prepare( $sql );
        $query->execute( [":userId" => $userId] );
        $result = $query->fetch(); 
        if ( !$result )
            $result = [];
        return $result;
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
            WHERE id = :id 
        ";
        $query = $this->_mdbd->getDBConn()->prepare( $sql );
        $query->execute( [":id" => $id] );
        $result = $query->fetch(); 
        if ( !$result )
            $result = [];
        return $result;
    }

    public function refreshAccessToken( int $sessionId, string $newExpiry ): bool {
        $updateSql = "UPDATE sessions SET accessTokenExpiry = '$newExpiry' WHERE id = $sessionId";
        $query  = $this->_mdbd->getDBConn()->prepare( $updateSql );
        return ( $query->execute() && $query->rowCount() === 1 );       
    }

}