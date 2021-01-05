<?php

namespace App\Controllers;

use App\Database\MariaDBDriver           as MariaDBDriver;
use App\Http\Requests\Request            as Request;
use App\Http\Responses\Json\JsonResponse as JsonResponse;

class HomeController extends Controller {

    public function __construct( Request $request ) {
        parent::__construct( $request );
    }

    protected function _initResponse() : void {
        if ( $this->_request->getMethod() === "GET" ) {
            $dbs = MariaDBDriver::getInstance();
            $this->_response = 
                $dbs->isUp() ?
                    new JsonResponse(
                        200,
                        [
                            "topmafia.net is up",
                            "made with ❤️ using a 💻 and PHP"
                        ],
                        true
                    )
                :
                    new JsonResponse(
                        500,
                        [
                            "topmafia.net is down 👎",
                            "please try to come back later",
                        ],
                        false
            );
        } else 
            $this->_response = new JsonResponse( 405, ["request method not allowed"], false );
    } // EO _initResponse(

} // EO DefaultController