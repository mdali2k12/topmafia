<?php

namespace App\Models;

use App\Database\UserDAO;
use App\Helpers\StringsTrait;
use App\Services\LoggerService;
use App\Validators\StringsValidator;

class User {

    use StringsTrait;
    use StringsValidator;

    private int    $_id = 0; // id 0 means user model has not been hydrated
    private string $_email;
    private string $_gender;
    private string $_password;
    private string $_unhashedPassword = "";
    public  string $username; 

    public function __construct( $identifier ) {
        $this->_inflate( $identifier );
    }

    private function _inflate( $identifier ) {
        $userDao = new UserDAO();
        $fetched = $userDao->get( $identifier );
        if ( $fetched["rowCount"] > 0 ) {
            $this->_id       = $fetched["id"];
            $this->_email    = $fetched["email"];
            $this->_gender   = $fetched["gender"];
            $this->_password = $fetched["password"];
            $this->username  = $fetched["username"];
        }
    }

    public static function exists( string $identifier ): bool {
        $userDao = new UserDAO();
        return $userDao->exists( $identifier );
    }

    public function generateNewPassword() : bool {
        $userDao                 = new UserDAO();
        $this->_unhashedPassword = $this->generateRandomPassword();
        $hash                    = $this->appHash( $this->_unhashedPassword );
        return $userDao->updateUserPassword( $this->_id, $hash );
    }

    public function getEmail(): string {
        return $this->_email;
    }

    public function getHashedPassword() : string {
        return $this->_password;
    }

    public function getId(): int {
        return $this->_id;
    }

    public static function getOnlinePlayersCount() : int {
        $userDao = new UserDAO();
        return $userDao->getOnlinePlayersCount();
    }

    public static function getPlayersCount() : int {
        $userDao = new UserDAO();
        return $userDao->getPlayersCount();
    }

    public function getUnhashedPassword(): string {
        return $this->_unhashedPassword;
    }

    public function nullifyUnhashedPassword() : void {
        $this->_unhashedPassword = " ";
    }

    public function isVerified() : bool {
        $userDao = new UserDAO();
        return $userDao->checkIsVerified( $this->_id );
    }

    public function read() : array {
        $payload = [];
        $payload["user"] = [
            "id"       => $this->_id,
            "email"    => $this->_email,
            "gender"   => $this->_gender,
            "username" => $this->username
        ];
        return $payload;
    }

    public function signUp( array $userPayload ) : bool {
        // business logic validation rounds
        if (
            $this->validatePassword( $userPayload["password"] )
            && $this->validateUserEmail( $userPayload["email"] ) 
            && $this->validateUsername( $userPayload["username"] )
            && $this->validateGender( $userPayload["gender"] )
        ) {
            $userDao                 = new UserDAO();
            $userPayload["password"] = $this->appHash( $userPayload["password"] );
            $userDao->signUp( $userPayload );
            $this->_inflate( $userPayload["username"] );
            return $this->_id != 0;
        }
        return false;
    }

    // SO business logic input validation
    public function validateUserEmail( string $emailInput ): bool {
        $userDao = new UserDAO();
        $emailInput = $this->sanitizeStringInput( $emailInput );
        if ( 
            $this->validateEmail( $emailInput ) 
            && !$this->exists( $emailInput ) 
            && !$userDao->emailIsBanned( $emailInput )
        )
            return true;
        return false;
    }
    public function validateGender( string $genderInput ): bool {
        return in_array( $genderInput, ["Male", "Female"] );
    }
    public function validatePassword( string $passwordInput ) {
        $passwordInput = $this->sanitizeStringInput( $passwordInput );
        if ( 
            $this->validateStringInputLength( $passwordInput, 8, 254 ) 
            && $this->validateAlphaNumeric( $passwordInput )
        ) return true;
        else return false;
    }
    public function validateUsername( string $usernameInput ) : bool {
        if ( 
            $this->validateAlphaNumeric( $usernameInput ) 
            && $this->validateStringInputLength( $usernameInput, 6, 15 ) 
            && !$this->exists( $usernameInput )
        )
            return true;
        return false;
    }
    // EO business logic specific validation

    public function verifyAccount() : bool {
        $userDao = new UserDAO();
        return $userDao->updateIsVerifiedField( $this->_id );
    }

}