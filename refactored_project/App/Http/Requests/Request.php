<?php

namespace App\Http\Requests;

use App\Helpers\StringsTrait as StringsTrait;

abstract class Request {

    use StringsTrait;

    protected string $_completeUrl   = "";
    private string   $_endpoint      = '/';
    private bool     $_hasIdentifier = false;
    protected array  $_headers       = [];
    private string   $_identifier    = "";
    private string   $_method;
    private bool     $_urlIsValid    = false;

    public function __construct() {
        $this->_init();
    } // EO constructor

    private function _init() {
        $this->_setHeaders();
        $this->_setCompleteUrl();
        $this->_setUrlValidity();
    }

    private function _setUrlValidity() : void {
        if ( 
            // here we verify that the server host name matches the host name loaded in .env file
            \in_array( $_SERVER['HTTP_HOST'], [$_ENV['SERVER_HOST_NAME'], $_ENV['SERVER_HOST_NAME_2']] )
            && 
            filter_var( $this->_completeUrl, FILTER_VALIDATE_URL ) 
        ) {
            $this->_urlIsValid = true;
            $this->_method     = $_SERVER["REQUEST_METHOD"];
            $this->_setEndpoint( parse_url( $this->_completeUrl, PHP_URL_PATH ) );
        }
    } // EO _setUrlValidity(

    protected function _urlIsValid() : bool {
        return $this->_urlIsValid;
    }      

    public function hasIdentifier() : bool {
        return $this->_hasIdentifier;
    }

    abstract public function isValid() : bool;

    // SO setters/getters
    private function _setCompleteUrl() : void {
        $completeUrl = filter_var( 
            ( isset($_SERVER['HTTPS'] ) ? 'https' : 'http' ).'://'.$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'], 
            FILTER_SANITIZE_URL 
        );
        $this->_completeUrl = $completeUrl;
    }
    private function _setEndpoint( string $endpoint ) : void {
        $this->_endpoint = $endpoint;
        $this->_setIdentifier( $endpoint );
    }
    private function _setHeaders() : void {
        $headers        = [];
        $requestHeaders = getallheaders();
        foreach ( $requestHeaders as $key => $value ) {
            if ( 
                $this->sanitizeStringInput( $this->removeSpaces( $key ) )   != false 
                &&
                $this->sanitizeStringInput( $this->removeSpaces( $key ) )   != "" 
                &&  
                $this->sanitizeStringInput( $this->removeSpaces( $value ) ) != false
                &&
                $this->sanitizeStringInput( $this->removeSpaces( $value ) ) != ""
            )
                $headers[$key] = $value;
        }
        $this->_headers = $headers;
    } // EO _setHeaders
    private function _setIdentifier( string $path ) : void {
        $pathToParse = explode( "/", $path );
        if( count( $pathToParse ) === 3 && !is_null( $pathToParse[2] ) ) {
            $this->_hasIdentifier = true;
            $this->_identifier    = $this->sanitizeStringInput( $pathToParse[2] );
            $this->_endpoint      = "/".$pathToParse[1];
        }
    } // EO _setIdentifier(
    public function getCompleteUrl() : string {
        return $this->_completeUrl;
    }
    public function getEndpoint(): string {
        return $this->_endpoint;
    }
    public function getHeaders() : array {
        return $this->_headers;
    }
    public function getIdentifier() : string {
        return $this->_identifier;
    }
    public function getMethod() : string {
        return $this->_method;
    }
    // EO setters/getters

} // EO class