<?php

namespace App\Http\Requests;

use App\Http\Requests\Request as Request;

class GetRequest extends Request {

    protected array  $_queryStrings  = [];

    public function __construct() {
        parent::__construct();
        $this->_setQueryStrings( $this->_completeUrl );
    } 

    // @Override
    public function isValid() : bool {
        return $this->_urlIsValid();
    }

    // SO setters/getters
    public function getQueryStrings() : array {
        return $this->_queryStrings;
    }
    private function _setQueryStrings( string $url ) : void {
        $queryStrings = explode( "&", parse_url( $url, PHP_URL_QUERY ) );
        if ( count( $queryStrings ) > 0 ) {
            for ( $i = 0; $i < count( $queryStrings ); $i++ ) { 
                if ( strpos( $queryStrings[$i], '=' ) != false ) {
                    if ( strrpos( $queryStrings[$i], "tok=", - strlen( $queryStrings[$i] )) !== false ) {
                        $this->_queryStrings["tok"] = substr( $queryStrings[$i], strpos( $queryStrings[$i], "tok=" ) + 4 );
                    } else {
                        $qsArr = explode( "=", $queryStrings[$i] );
                        $key   = $qsArr[0];
                        if (
                            $this->sanitizeStringInput( $this->removeSpaces( $key ) ) != "" 
                            &&
                            $this->sanitizeStringInput( $this->removeSpaces( $key ) ) != false 
                        ) {
                            $value = null;
                            if ( isset( $qsArr[1] ) )
                                $value = $this->sanitizeStringInput( urldecode( $qsArr[1] ) );
                            if( $value != false && $value != "" )
                                $this->_queryStrings[$key] = $value;
                        }
                    }
                }
            }
        }
    }
    // EO setters/getters

} // EO class