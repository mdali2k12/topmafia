<?php

namespace App\Models;

use App\Database\UserDAO;
use App\Helpers\StringsTrait;
use App\Validators\StringsValidator;

class User {

    use StringsTrait;
    use StringsValidator;

    // SO static methods
    public static function exists( string $identifier ): bool {
        $userDao = new UserDAO();
        return $userDao->exists( $identifier );
    }
    public static function getOnlinePlayersCount() : int {
        $userDao = new UserDAO();
        return $userDao->getOnlinePlayersCount();
    }
    public static function getPlayersCount() : int {
        $userDao = new UserDAO();
        return $userDao->getPlayersCount();
    }
    // EO static methods

    private int     $_id = 0; // id 0 means user model has not been hydrated
    private string  $_email;
    private string  $_gender;
    private string  $_password;
    private string  $_unhashedPassword = "";
    private UserDAO $_userDao;
    public  string  $username; 

    public function __construct( $identifier ) {
        $this->_userDao = new UserDAO();
        $this->_inflate( $identifier );
    }

    private function _inflate( $identifier ) {
        $fetched = $this->_userDao->get( $identifier );
        if ( $fetched["rowCount"] > 0 ) {
            $this->_id       = $fetched["id"];
            $this->_email    = $fetched["email"];
            $this->_gender   = $fetched["gender"];
            $this->_password = $fetched["password"];
            $this->username  = $fetched["username"];
        }
    }

    public function generateNewPassword() : bool {
        $this->_unhashedPassword = $this->generateHumanReadablePassword();
        $hash                    = $this->appHash( $this->_unhashedPassword );
        return $this->_userDao->updateUserPassword( $this->_id, $hash );
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

    public function getUnhashedPassword(): string {
        return $this->_unhashedPassword;
    }

    public function nullifyUnhashedPassword() : void {
        $this->_unhashedPassword = " ";
    }

    public function isVerified() : bool {
        return $this->_userDao->checkIsVerified( $this->_id );
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
            && $this->validateGender( $userPayload["gender"] )
        ) {
            $userPayload["password"] = $this->appHash( $userPayload["password"] );
            $this->_userDao->signUp( $userPayload );
            $this->_inflate( $userPayload["username"] );
            return $this->_id != 0;
        }
        return false;
    }

    public function updatePassword( string $password ): bool {
        $hash    = $this->appHash( $password);
        return $this->_userDao->updateUserPassword( $this->_id, $hash );
    }

    // SO business logic input validation
    public function validateGender( string $genderInput ): bool {
        return in_array( $this->sanitizeStringInput( $genderInput ), ["Male", "Female"] );
    }
    public function validatePassword( string $passwordInput ) {
        $passwordInput = $this->sanitizeStringInput( $passwordInput );
        return $this->validateStringInputLength( $passwordInput, 8, 254 );
    }
    public function validateUserEmail( string $emailInput ): bool {
        $emailInput = $this->sanitizeStringInput( $emailInput );
        return !$this->exists( $emailInput );
    }
    public function validateUserEmailIsNotBanned( string $emailInput ): bool {
        $emailInput = $this->sanitizeStringInput( $emailInput );
        return !$this->_userDao->emailIsBanned( $emailInput );
    }
    public function validateUsername( string $usernameInput ) : bool {
        return !$this->exists( $usernameInput );
    }
    public function validateUsernameLength( string $usernameInput ) : bool {
        return $this->validateStringInputLength( $usernameInput, 6, 15 ); 
    }
    // EO business logic specific validation

    public function verifyAccount() : bool {
        return $this->_userDao->updateIsVerifiedField( $this->_id );
    }

}