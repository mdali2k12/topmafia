<?php

namespace App\Models;

use App\Database\AppTokenDAO;

use App\Helpers\StringsTrait;

class AppToken {

    use StringsTrait;

    private AppTokenDAO $_atdao;

    public function __construct() {
        $this->_atdao = new AppTokenDAO();
    }

    // the type must be one of the types present in the corresponding field enum in db
    public function create( int $userId, string $type ) : string {
        $token = $this->buildToken();
        $this->_atdao->create( $userId, $type, $token );
        return $token;
    }

}