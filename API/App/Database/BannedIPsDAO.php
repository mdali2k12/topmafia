<?php

namespace App\Database;

class BannedIPsDAO extends DAO {

    public function __construct() {
        parent::__construct();
     }

    // TODO fix app' crash case db problem here
    public function exists( $ip ): bool {
        $sql   = "
            SELECT COUNT(*) AS rowCount 
            FROM bannedips 
            WHERE ip = :ip 
        ";
        $query = $this->_mdbd->getDBConn()->prepare( $sql );
        $query->execute( [":ip" => $ip] );
        $rowCount = intval( $query->fetch()["rowCount"] );
        return $rowCount > 0;
    }

}
