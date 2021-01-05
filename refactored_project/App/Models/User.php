<?php

namespace App\Models;

use App\Database\UserDAO;

class User {

    public static function getPlayersCount() : int {
        $userDao = new UserDAO();
        return $userDao->getPlayersCount();
    }

    public static function getOnlinePlayersCount() : int {
        $userDao = new UserDAO();
        return $userDao->getOnlinePlayersCount();
    }

}