<?php

namespace App\Controllers;

use App\Http\Requests\Request            as Request;
use App\Http\Responses\Json\JsonResponse as JsonResponse;

class NotFoundController extends Controller {

    public function __construct( Request $request ) {
        parent::__construct( $request );
    }

    protected function _initResponse() : void {
        $this->_response = new JsonResponse( 404, ["not found"], false );
        $this->_response->setToCache( true );
        $this->_response->setHeaderCacheControl( "Cache-Control: max-age=86400" ); // one day
    } 

} // EO class