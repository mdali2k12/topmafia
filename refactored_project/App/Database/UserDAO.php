<?php

namespace App\Database;

class UserDAO extends DAO {

    public function __construct() {
       parent::__construct();
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
    
    public function getPlayersCount() : int {
        if ( !is_null( $this->_mdbd->getDBConn() )) {
            $query = $this->_mdbd->getDBConn()->prepare( "SELECT COUNT(id) AS playersCount FROM users WHERE isPlayer = 1" );
            $query->execute();
            $count = intval( $query->fetch()["playersCount"] );
            return $count;
        }
        else return 0;
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
        else return 0;
    }

    public function getUser( $identifier ) : array {
        $sql    = "
            SELECT id, email, username, COUNT(*) AS rowCount 
            FROM users 
            WHERE id = :id 
            OR email = :email 
            OR username = :username
        ";
        $query  = $this->_mdbd->getDBConn()->prepare( $sql );
        $query->execute( [":id" => $identifier, ":email" => $identifier,  ":username" => $identifier] );
        $result = $query->fetch(); 
        if ( !$result )
            $result = [];
        return $result;
    }

    public function updateUserPassword( int $id, string $hash ): bool {
        $updateSql = "UPDATE users SET password = $hash WHERE id = $id";
        $query  = $this->_mdbd->getDBConn()->prepare( $updateSql );
        return ( $query->execute() && $query->rowCount() === 1 );        
    }

}