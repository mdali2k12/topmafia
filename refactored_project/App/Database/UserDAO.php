<?php

namespace App\Database;

use App\Helpers\StringsTrait;
use App\Services\LoggerService;

// TODO DRY
class UserDAO extends DAO {

    use StringsTrait;

    public function __construct() {
       parent::__construct();
    }

    public function checkIsVerified( int $id ): bool {
        $sql    = "
            SELECT isVerified, COUNT(*) AS rowCount 
            FROM users 
            WHERE id = :id 
        ";
        $query  = $this->_mdbd->getDBConn()->prepare( $sql );
        $query->execute( [":id" => $id] );
        $result = $query->fetch(); 
        if ( !$result ) return boolval( 0 );
        return boolval( $result["isVerified"] );
    }

    public function emailIsBanned( string $email ): bool {
        $sql   = "
            SELECT COUNT(*) AS rowCount 
            FROM bannedemails 
            WHERE email = :email 
        ";
        $query = $this->_mdbd->getDBConn()->prepare( $sql );
        $query->execute( [":email" => $email] );
        $rowCount = intval( $query->fetch()["rowCount"] );
        return $rowCount > 0;
    }

    public function exists( string $identifier ): bool {
        $sql   = "
            SELECT COUNT(*) AS rowCount 
            FROM users 
            WHERE id = :id 
            OR email = :email 
            OR username = :username
        ";
        $query = $this->_mdbd->getDBConn()->prepare( $sql );
        $query->execute( [":id" => $identifier, ":email" => $identifier, ":username" => $identifier] );
        $rowCount = intval( $query->fetch()["rowCount"] );
        return $rowCount > 0;
    }

    public function get( $identifier ) : array {
        $sql    = "
            SELECT u.id AS id, email, username, gender, password, COUNT(*) AS rowCount 
            FROM users u
            LEFT JOIN apptokens at ON at.userId = u.id
            WHERE u.id   = :id 
            OR email     = :email 
            OR username  = :username
            OR at.token  = :attoken
        ";
        $query  = $this->_mdbd->getDBConn()->prepare( $sql );
        $query->execute( [":id" => $identifier, ":email" => $identifier,  ":username" => $identifier, ":attoken" => $identifier] );
        $result = $query->fetch(); 
        if ( !$result )
            $result = [];
        // LoggerService::getInstance()->log( "info", "GET USER FROM DAO => ".json_encode( $result ) );
        return $result;
    }

    public function getHashedPassword( int $id ) : string {
        $sql    = "
            SELECT password, COUNT(*) AS rowCount 
            FROM users 
            WHERE id = :id 
        ";
        $query  = $this->_mdbd->getDBConn()->prepare( $sql );
        $query->execute( [":id" => $id] );
        $result = $query->fetch(); 
        if ( !$result ) return "";
        return $result["password"];
    }

    public function getOnlinePlayersCount() : int {
        if ( !is_null( $this->_mdbd->getDBConn() )) {
            $query = $this->_mdbd->getDBConn()->prepare( "
                SELECT COUNT(users.id) AS onlinePlayersCount
                FROM users 
                INNER JOIN sessions ON sessions.userId = users.id
                WHERE isPlayer = 1
                AND sessions.updatedAt  > NOW() - INTERVAL 15 MINUTE
            " );
            $query->execute();
            $count = intval( $query->fetch()["onlinePlayersCount"] );
            return $count;
        }
        return 0;
    }

    public function getPlayersCount() : int {
        if ( !is_null( $this->_mdbd->getDBConn() )) {
            $query = $this->_mdbd->getDBConn()->prepare( "SELECT COUNT(id) AS playersCount FROM users WHERE isPlayer = 1" );
            $query->execute();
            $count = intval( $query->fetch()["playersCount"] );
            return $count;
        }
        return 0;
    }

    public function signUp( array $userPayload ) : int {
        $insertedId = 0;
        if ( !is_null( $this->_mdbd->getDBConn() ) ) {
            $sql            = "
                INSERT INTO users( username, email, password, gender )
                VALUES( :username, :email, :password, :gender )
            ";
            $query = $this->_mdbd->getDBConn()->prepare( $sql );
            $query->execute( [
                ":username" => $userPayload["username"], 
                ":email"    => $userPayload["email"],  
                ":password" => $userPayload["password"],
                ":gender"   => $userPayload["gender"]
            ] );
            $query->rowCount() === 1 ?? $insertedId = $this->_mdbd->getDBConn()->lastInsertId();
        } 
        return $insertedId;
    }

    public function updateIsVerifiedField( int $id ): bool {
        $updateSql = "UPDATE users SET isVerified = TRUE WHERE id = :id";
        $query  = $this->_mdbd->getDBConn()->prepare( $updateSql );
        return ( 
            $query->execute( [
                ":id"   => $id
            ]) 
            && $query->rowCount() === 1 
        );        
    }

    public function updateUserPassword( int $id, string $hash ): bool {
        $updateSql = "UPDATE users SET password = :hash WHERE id = :id";
        $query  = $this->_mdbd->getDBConn()->prepare( $updateSql );
        return ( 
            $query->execute( [
                ":hash" => $hash,
                ":id"   => $id
            ]) 
            && $query->rowCount() === 1 
        );        
    }

}