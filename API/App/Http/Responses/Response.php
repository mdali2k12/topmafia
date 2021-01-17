<?php

namespace App\Http\Responses;

abstract class Response {

    private   array  $_additionalHeaders = [];
    // value to be completed on later processing on sub response object creation (example with JsonResponse)
    protected string $_contentTypeHeader = "Content-Type: "; 
    private   int    $_httpStatusCode;

    // you dont want to cache credentials or access tokens, this is why $toCache should be set to false by default
    protected string $_headerCacheControl;
    private   bool   $_toCache = false; 

    public function __construct( int $httpStatusCode ) {
        $this->_httpStatusCode = $httpStatusCode;
    }
    
    // SO abstract methods
    abstract protected function _sendSpecific() : void; 
    // EO abstract methods

    public function send() : void {
        header( $this->_contentTypeHeader );
        header( $this->_toCache == false ? "Cache-Control: no-store": $this->_headerCacheControl );
        if ( count( $this->_additionalHeaders ) > 0 )
            foreach( $this->_additionalHeaders as $header) {
                header( $header );
            }
        http_response_code( $this->_httpStatusCode );
        $this->_sendSpecific();
    }

    // SO getters/setters
    public function getHttpStatusCode() : int {
        return is_null( $this->_httpStatusCode ) ? 500 : $this->_httpStatusCode;
    }
    public function setHeaderCacheControl( string $headerCacheControl ) : void {
        $this->_headerCacheControl = $headerCacheControl; // for an example "Cache-Control: max-age=60" 
    }
    public function setAdditionalHeaders( array $headers ): void {
        $this->_additionalHeaders = $headers;
    }
    public function setToCache( bool $toCache ) : void {
        $this->_toCache = $toCache;
    }
    // EO getters/setters

}

