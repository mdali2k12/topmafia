<?php

namespace App\Database;

class AppTokenDAO extends DAO {

    public function __construct() {
        parent::__construct();
    }

    public function create( int $userId, string $type, string $token ) : void {
        if ( !is_null( $this->_mdbd->getDBConn() ) ) {
            $sql = "
                INSERT INTO apptokens( userId, type, token )
                VALUES( :userId, :type, :token )
            ";
            $query = $this->_mdbd->getDBConn()->prepare( $sql );
            $query->execute( [
                ":userId"      => $userId,
                ":type"        => $type,
                ":token"       => $token
            ] );
        }
    }

    public function getUserId( string $token ) : int {
        $sql    = "
            SELECT userId, COUNT(*) AS rowCount 
            FROM apptokens 
            WHERE token = :token 
        ";
        $query  = $this->_mdbd->getDBConn()->prepare( $sql );
        $query->execute( [":token" => $token] );
        $result = $query->fetch(); 
        if ( !$result ) return 0;
        return intval( $result["userId"] );
    }

    public function matchTypeAndToken( string $type, string $token ) : bool {
        $sql   = "
            SELECT COUNT(*) AS rowCount 
            FROM apptokens 
            WHERE type  = :type 
            AND   token = :token
            ORDER BY createdAt DESC
        ";
        $query = $this->_mdbd->getDBConn()->prepare( $sql );
        $query->execute( [":type" => $type, ":token" => $token] );
        $rowCount = intval( $query->fetch()["rowCount"] );
        return $rowCount > 0;
    }

    public function updateVerifiedAt( string $token ): bool {
        $updateSql = "UPDATE apptokens SET consumedAt = NOW() WHERE token = :token";
        $query  = $this->_mdbd->getDBConn()->prepare( $updateSql );
        return ( 
            $query->execute( [
                ":token"   => $token
            ]) 
            && $query->rowCount() === 1 
        );        
    }

}