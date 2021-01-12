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

}