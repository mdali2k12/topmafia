<?php

namespace App\Services;

use Monolog\Logger;
use Monolog\Handler\StreamHandler;

// TODO create specialized loggers from here
class LoggerService {

    private static $_instance = null;
    
    private Logger $_logger;

    private function __construct() {
        $this->_logger = new Logger( "app" );
        $this->_init();
    } 
    public static function getInstance() 
    {
        if ( is_null( self::$_instance ) ) {
            self::$_instance = new LoggerService();  
        }
        return self::$_instance;
    }
    // EO pair constructor/get instance

    private function _init() {
        $this->_logger->pushHandler(
            new StreamHandler( "./logs/app.log", Logger::INFO )
        );
    }

    public function log( string $type, string $message ) {
        $this->_logger->{$type}( $message );
    }

}