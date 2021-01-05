<?php

namespace App\Database;

class UserDAO extends DAO {

    public function __construct() {
       parent::__construct();
    }
    
    public function getPlayersCount() : int {
        $query = $this->_mdbd->getDBConn()->prepare( "SELECT COUNT(id) AS playersCount FROM users WHERE isPlayer = 1" );
        $query->execute();
        $count = intval( $query->fetch()["playersCount"] );
        return $count;
    }

    public function getOnlinePlayersCount() : int {
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

}