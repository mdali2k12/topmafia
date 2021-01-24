<?php

use App\Models\User;

use PHPUnit\Framework\TestCase as TestCase;

/**
 * 
 * by convention we use "testUser" when inserting user data
 * 
 */
class UserTest extends TestCase {

    private $_db_conn = null;

    // taken from user DAO
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
    private function _deleteUser( int $userId ): void {
        $sql = "
            DELETE FROM users WHERE id = :id
        ";
        $query = $this->_db_conn->prepare( $sql );
        $query->execute( [":id" => $userId] );
    }
    // EO taken from UserDAO

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

    public function testGenerateSponsorshipLink(): void {
        // arrange: we create a user and we invoke a user model
        $userId = $this->_signUp( [
            "username" => "testUser",
            "email"    => "testUser",
            "password" => "testUser",
            "gender"   => "Male"
        ]);
        $userM = new User();
        // act: we generate a sponsorship link
        $generatedSponsorshipLink = $userM->generateSponsorshipLink( $userId );
        // assert: we verify that link is valid
        $this->assertTrue( str_contains( $generatedSponsorshipLink, "/?sponsorid=".$userId ));
        // tear down: we delete the created user
        $this->_deleteUser( $userId ); 
    }

    protected function tearDown(): void {
        $this->_db_conn = null;
    }

}