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

    public function checkInSponsorship( int $id ): array {
        $sql = "
            SELECT id, sponsorId, sponsoredId, COUNT(*) AS rowCount 
            FROM sponsorships 
            WHERE sponsorId = :id 
            OR sponsoredId  = :id
        ";
        $query  = $this->_mdbd->getDBConn()->prepare( $sql );
        $query->execute( [":id" => $id] );
        $result = $query->fetchAll(); 
        return !$result ? [] : $result;
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

    public function deleteSponsorship( int $sponsorshipId ): void {
        $sql = "
            DELETE FROM sponsorships WHERE id = :id
        ";
        $query = $this->_mdbd->getDBConn()->prepare( $sql );
        $query->execute( [":id" => $sponsorshipId] );
    }

    // tested
    public function deleteUser( int $userId ): void {
        $sql = "
            DELETE FROM users WHERE id = :id
        ";
        $query = $this->_mdbd->getDBConn()->prepare( $sql );
        $query->execute( [":id" => $userId] );
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

    public function insertSponsorship( int $sponsoredId, int $sponsorId, string $ipAddress, string $userAgent ) : int {
        $insertedId = 0;
        if ( !is_null( $this->_mdbd->getDBConn()) ) {
            $sql = "
                INSERT INTO sponsorships( sponsoredId, sponsorId, ip, userAgent )
                VALUES( :sponsoredId, :sponsorId, :ip, :userAgent )
            ";
            $query = $this->_mdbd->getDBConn()->prepare( $sql );
            if ( 
                $query->execute( [
                    ":sponsoredId"        => $sponsoredId,
                    ":sponsorId"          => $sponsorId,
                    ":ip"                 => $ipAddress,
                    ":userAgent"          => $userAgent  
                ] ) 
            ) {
                $stmt       = $this->_mdbd->getDBConn()->query( "SELECT LAST_INSERT_ID()" );
                $insertedId = $stmt->fetchColumn();
            }
        }
        return $insertedId;
    }

    public function signUp( array $userPayload ) : int {
        $insertedId = 0;
        if ( !is_null( $this->_mdbd->getDBConn() ) ) {
            $sql            = "
                INSERT INTO users( username, email, password, gender )
                VALUES( :username, :email, :password, :gender )
            ";
            $query = $this->_mdbd->getDBConn()->prepare( $sql );
            if (
                $query->execute( [
                    ":username" => $userPayload["username"], 
                    ":email"    => $userPayload["email"],  
                    ":password" => $userPayload["password"],
                    ":gender"   => $userPayload["gender"]
                ] )
            ) {
                $stmt       = $this->_mdbd->getDBConn()->query( "SELECT LAST_INSERT_ID()" );
                $insertedId = $stmt->fetchColumn();
            }
        } 
        return $insertedId;
    }

    public function sponsorshipIpExists( string $ipAddress ): bool {
        $sql   = "
            SELECT COUNT(*) AS rowCount 
            FROM sponsorships 
            WHERE ip = :ip
        ";
        $query = $this->_mdbd->getDBConn()->prepare( $sql );
        $query->execute( [":ip" => $ipAddress] );
        $rowCount = intval( $query->fetch()["rowCount"] );
        return $rowCount > 0;
    }

    // tested 
    public function sponsorshipUserAgentIpComboExists( string $userAgent, string $ipAddress ): bool {
        $sql   = "
            SELECT COUNT(*) AS rowCount 
            FROM sponsorships 
            WHERE ( userAgent = :userAgent AND ip = :ip )
        ";
        $query = $this->_mdbd->getDBConn()->prepare( $sql );
        $query->execute( [":userAgent" => $userAgent, ":ip" => $ipAddress] );
        $rowCount = intval( $query->fetch()["rowCount"] );
        return $rowCount > 0;
    }

    public function updateSponsorshipStatus( int $sponsorshipId ) : bool {
        $updateSql = "UPDATE sponsorships SET isVerified = TRUE WHERE id = :id";
        $query     = $this->_mdbd->getDBConn()->prepare( $updateSql );
        return ( 
            $query->execute( [
                ":id" => $sponsorshipId
            ]) 
            && $query->rowCount() === 1 
        );   
    }

    public function updateIsVerifiedField( int $id ): bool {
        $updateSql = "UPDATE users SET isVerified = TRUE WHERE id = :id";
        $query     = $this->_mdbd->getDBConn()->prepare( $updateSql );
        return ( 
            $query->execute( [
                ":id" => $id
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