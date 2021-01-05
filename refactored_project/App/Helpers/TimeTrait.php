<?php

namespace App\Helpers;

use App\Database\MariaDBDriver;
use DateTime;

trait TimeTrait {

    public function dateIsExpired( string $date ) : bool {
        $dateTime = DateTime::createFromFormat( 'Y-m-d H:i:s', $date );
        $now      = new DateTime();
        return $dateTime < $now;
    }
    
    public function getNow() : string {
        $now = new DateTime();
        return $now->format('Y-m-d H:i:s'); // MariaDB datetime format
    }

    public function incrementDateTimeWithSeconds( int $seconds ) : string {
        $dbDriverName = "App\DAOs\\".$_ENV["DB_DRIVER"]."Driver";
        $driver       = new $dbDriverName();
        $now          = new DateTime();
        return $driver->incrementDateTimeWithSeconds( $now->format('Y-m-d H:i:s'), $seconds );
    }

} // EO trait