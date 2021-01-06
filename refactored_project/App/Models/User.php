<?php

namespace App\Models;

use App\Database\UserDAO;
use App\Helpers\StringsTrait;

class User {

    use StringsTrait;

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

}