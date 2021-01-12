<?php

namespace App\Database;

use App\Services\MariaDBService;

use DateInterval;
use DateTime;

abstract class DAO {

    protected $_mdbd;

    public function __construct() {
        $this->_mdbd = MariaDBService::getInstance();
    }

    // MariaDB default datetime format is 'Y-m-d H:i:s'

    public function dateIsExpired( string $date ) : bool {
        $dateTime = DateTime::createFromFormat( 'Y-m-d H:i:s', $date );
        $now      = new DateTime();
        return $dateTime < $now;
    }
    
    public function getNow() : string {
        $now = new DateTime();
        return $now->format('Y-m-d H:i:s'); 
    }

    public function incrementDateTimeWithDays( int $days, string $start = null ) : string {
        $date = DateTime::createFromFormat(
            'Y-m-d H:i:s', 
            is_null( $start ) ? $this->getNow() : $start
        );
        $interval = new DateInterval( 'P'.$days.'D' );
        $date->add( $interval );
        return $date->format('Y-m-d H:i:s'); 
    }

    // TODO validate $start value input, e.g. make sure it's convertible into a date
    public function incrementDateTimeWithSeconds( int $seconds, string $start = null ) : string {
        $date = DateTime::createFromFormat(
            'Y-m-d H:i:s', 
            is_null( $start ) ? $this->getNow() : $start
        );
        $date->add( new DateInterval( "PT$seconds".'S' ) );
        return $date->format('Y-m-d H:i:s');
    }
    
}