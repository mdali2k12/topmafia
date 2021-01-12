<?php

namespace App\Services;

use DateTime;
use PDOException;

class MariaDBService{

    private               $_db_conn = null;
    private bool          $_dbIsUp;
    private LoggerService $_loggerService;

    private static $_instance = null;

    private function __construct() {
        $this->_init();
    } 
    public static function getInstance() 
    {
        if ( is_null( self::$_instance ) ) {
            self::$_instance = new MariaDBService();  
        }
        return self::$_instance;
    }
    // EO pair constructor/get instance

    private function _init() : void {
        // getting the logger
        $this->_loggerService = LoggerService::getInstance();
        // check that PDO extension is enabled
        if( in_array ( 'pdo_mysql', get_loaded_extensions() ) ) {
            // TODO admin feedback with getAttribute(PDO::ATTR_SERVER_INFO) and/or getAttribute(PDO::ATTR_CONNECTION_STATUS)
            $dsn = "mysql:host=".$_ENV['DB_HOST'].";dbname=".$_ENV['DB_NAME'].";charset=utf8";
            $opt = array(
                \PDO::ATTR_ERRMODE            => \PDO::ERRMODE_EXCEPTION,
                \PDO::ATTR_DEFAULT_FETCH_MODE => \PDO::FETCH_ASSOC
            );
            try {
                $this->_db_conn = new \PDO( $dsn, $_ENV['DB_NAME'], $_ENV['DB_PASSWORD'], $opt );
                $this->_dbIsUp = true;
            } catch ( PDOException $pdoe ) {
                $this->_loggerService->log( 
                    "error",
                    ( new DateTime() )->format('Y-m-d H:i:s') . " - DBConnection : error while connecting to database => " . $pdoe->getMessage() . "\n"
                );
                $this->_dbIsUp = false;
            }
        } else 
            $this->_dbIsUp = false;
    }

    // closing the connection
    public function disconnect() {
        $this->_db_conn = null;
    }

    // return type is not specified because we must allow null
    public function getDBConn() {
        return $this->_db_conn;
    }

    public function isUp() : bool {
        return $this->_dbIsUp;
    }

}

