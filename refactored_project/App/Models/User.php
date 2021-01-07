<?php

namespace App\Models;

use App\Database\UserDAO;
use App\Helpers\StringsTrait;
use App\Validators\StringsValidator;

class User {

    use StringsTrait;
    use StringsValidator;

    private int    $_id = 0; // id 0 means user model has not been hydrated
    private string $_email;
    private string $_unhashedPassword;
    public  string $username; 

    public function __construct( $identifier ) {
        $this->_init( $identifier );
    }

    private function _init( $identifier ): void {
        $userDao = new UserDAO();
        $fetched = $userDao->getUser( $identifier );
        if ( $fetched["rowCount"] > 0 ) {
            $this->_id      = $fetched["id"];
            $this->email    = $fetched["email"];
            $this->username = $fetched["username"];
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

}