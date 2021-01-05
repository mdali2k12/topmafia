<?php

namespace App\Database;

abstract class DAO {

    protected $_mdbd;

    public function __construct() {
        $this->_mdbd = MariaDBDriver::getInstance();
    }
    
}