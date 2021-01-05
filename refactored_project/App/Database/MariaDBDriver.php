<?php

namespace App\Database;

use App\Helpers\TimeTrait as TimeTrait;
use PDOException;

class MariaDBDriver{

    use TimeTrait;

    private        $_db_conn = null;
    private bool   $_dbIsUp;
    private string $_logFilePath = "./logs/app/db.log";

    private static $_instance = null;

    private function __construct() {
        $this->_init();
    } 
    public static function getInstance() 
    {
        if ( is_null( self::$_instance ) ) {
            self::$_instance = new MariaDBDriver();  
        }
        return self::$_instance;
    }
    // EO pair constructor/get instance

    private function _init() : void {
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
                error_log(
                    $this->getNow() . " - DBConnection : error while connecting to database => " . $pdoe->getMessage() . "\n",
                    3,
                    $this->_logFilePath
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

