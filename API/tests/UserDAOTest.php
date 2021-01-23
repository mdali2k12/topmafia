<?php

use PHPUnit\Framework\TestCase as TestCase;

/**
 * 
 * by convention we use "testUser" when inserting user data
 * 
 */
class UserDAOTest extends TestCase {

    private $_db_conn = null;

    // SO UserDAO logic logic
    private function _deleteSponsorship( int $sponsorshipId ): void {
        $sql = "
            DELETE FROM sponsorships WHERE id = :id
        ";
        $query = $this->_db_conn->prepare( $sql );
        $query->execute( [":id" => $sponsorshipId] );
    }
    private function _deleteUser( int $userId ): void {
        $sql = "
            DELETE FROM users WHERE id = :id
        ";
        $query = $this->_db_conn->prepare( $sql );
        $query->execute( [":id" => $userId] );
    }
    public function _insertSponsorship( int $sponsoredId, int $sponsorId, string $ipAddress, string $userAgent ) : int {
        $insertedId = 0;
        if ( !is_null( $this->_db_conn ) ) {
            $sql = "
                INSERT INTO sponsorships( sponsoredId, sponsorId, ip, userAgent )
                VALUES( :sponsoredId, :sponsorId, :ip, :userAgent )
            ";
            $query = $this->_db_conn->prepare( $sql );
            if ( 
                $query->execute( [
                    ":sponsoredId"        => $sponsoredId,
                    ":sponsorId"          => $sponsorId,
                    ":ip"                 => $ipAddress,
                    ":userAgent"          => $userAgent  
                ] ) 
            ) {
                $stmt       = $this->_db_conn->query( "SELECT LAST_INSERT_ID()" );
                $insertedId = $stmt->fetchColumn();
            }
        }
        return $insertedId;
    }
    private function _signUp( array $userPayload ) : int {
        $insertedId = 0;
        if ( !is_null( $this->_db_conn ) ) {
            $sql            = "
                INSERT INTO users( username, email, password, gender )
                VALUES( :username, :email, :password, :gender )
            ";
            $query = $this->_db_conn->prepare( $sql );
            if (
                $query->execute( [
                    ":username" => $userPayload["username"], 
                    ":email"    => $userPayload["email"],  
                    ":password" => $userPayload["password"],
                    ":gender"   => $userPayload["gender"]
                ] )
            ) {
                $stmt       = $this->_db_conn->query( "SELECT LAST_INSERT_ID()" );
                $insertedId = $stmt->fetchColumn();
            }
        } 
        return $insertedId;
    }    
    private function _sponsorshipUserAgentIpComboExists( string $userAgent, string $ipAddress ): bool {
        $sql   = "
            SELECT COUNT(*) AS rowCount 
            FROM sponsorships 
            WHERE userAgent = :userAgent
            AND ip = :ip 
        ";
        $query = $this->_db_conn->prepare( $sql );
        $query->execute( [":userAgent" => $userAgent, ":ip" => $ipAddress] );
        $rowCount = intval( $query->fetch()["rowCount"] );
        return $rowCount > 0;
    }
    private function _userExists( string $identifier ): bool {
        $sql   = "
            SELECT COUNT(*) AS rowCount 
            FROM users 
            WHERE id = :id 
            OR email = :email 
            OR username = :username
        ";
        $query = $this->_db_conn->prepare( $sql );
        $query->execute( [":id" => $identifier, ":email" => $identifier, ":username" => $identifier] );
        $rowCount = intval( $query->fetch()["rowCount"] );
        return $rowCount > 0;
    }
    // EO UserDAO logic logic

    protected function setUp(): void {
        if( in_array ( 'pdo_mysql', get_loaded_extensions() ) ) {
            $dsn = "mysql:host=localhost;dbname=topmafia;charset=utf8";
            $opt = array(
                \PDO::ATTR_ERRMODE            => \PDO::ERRMODE_EXCEPTION,
                \PDO::ATTR_DEFAULT_FETCH_MODE => \PDO::FETCH_ASSOC
            );
            try {
                $this->_db_conn = new \PDO( $dsn, "topmafia", "topmafia", $opt );
            } catch ( PDOException $pdoe ) {}
        } 
    }
    
   /**
     * 
     * given an existing user,
     * when I delete this user,
     * then this user should not be referenced in db anymore
     * 
     */
    public function testDeleteUser() : void {
        /**
         * 
         * ARRANGE
         * we create one user
         * 
         */
        $userToDeleteId = $this->_signUp( [
            "username" => "testUser",
            "email"    => "testUser",
            "password" => "testUser",
            "gender"   => "Male"
        ]);
        /**
         * 
         * ACT
         * we delete this user
         * 
         */
        $this->_deleteUser( $userToDeleteId );
        /**
         * 
         * ASSERT
         * we make sure that this user doesnt exist anymore in db
         * 
         */
        $this->assertFalse( $this->_userExists( $userToDeleteId ));
        // TEAR DOWN: we delete user once more just in case failed
        $this->_deleteUser( $userToDeleteId );
    }

    /**
     * 
     * given an existing IP/User agent combination in the sponsorship table,
     * when I test its existence,
     * then the called method should return true
     * 
     */
    public function testSponsorshipUserAgentIpComboExists() : void {
        /**
         * 
         * ARRANGE
         * we insert two users to fill in the FK's
         * of the sponsorship we insert next
         * 
         */
        $sponsorId = $this->_signUp( [
            "username" => "testUser",
            "email"    => "testUser",
            "password" => "testUser",
            "gender"   => "Male"
        ]);
        $sponsoredId = $this->_signUp( [
            "username" => "testUser2",
            "email"    => "testUser2",
            "password" => "testUser2",
            "gender"   => "Male"
        ]);
        $sponsorShipId = $this->_insertSponsorship(
            $sponsoredId,
            $sponsorId,
            "::1",
            "USER_AGENT"
        );
        /**
         * 
         * ACT
         * we execute the if exists method
         * using same values than the previous insert
         * 
         */
        $assertion = $this->_sponsorshipUserAgentIpComboExists( "USER_AGENT", "::1" );
        /**
         * 
         * ASSERT
         * should be true
         * 
         */
        $this->assertTrue( $assertion );
        /**
         * 
         * TEAR DOWN
         * we delete inserted rows
         * 
         */
        $this->_deleteUser( $sponsorId );
        $this->_deleteUser( $sponsoredId );
        $this->_deleteSponsorship( $sponsorShipId );
    }

    protected function tearDown(): void {
        $this->_db_conn = null;
    }

}