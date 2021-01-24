<?php

namespace App\Services;

use App\Database\UserDAO;

/**
 * 
 * this class is responsible for interacting with users as a whole and not as an individual model
 * 
 */
class UsersService {

    private UserDAO $_userDao;

    public function __construct()
    {
        $this->_userDao = new UserDAO();
    }

    public function exists( string $identifier ): bool {
        return $this->_userDao->exists( $identifier );
    }

    public function extractCounterpartInSponsorshipRelationship( array $sponsorship, int $userId ) : int {
        // we extract the counterpart of the current user in the sponsorship relation
        $idToVerify = $sponsorship[array_keys( array_filter( $sponsorship, function( $value, $key ) use ( $userId ) {
            return $value != $userId && $key != "id";
        }, ARRAY_FILTER_USE_BOTH))[0]];
        return $idToVerify;
    }

    public function getOnlinePlayersCount() : int {
        return $this->_userDao->getOnlinePlayersCount();
    }

    public function getPlayersCount() : int {
        return $this->_userDao->getPlayersCount();
    }

}