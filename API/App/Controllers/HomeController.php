<?php

namespace App\Controllers;

use App\Database\MariaDBService           as MariaDBService;
use App\Http\Requests\Request            as Request;
use App\Http\Responses\Json\JsonResponse as JsonResponse;

class HomeController extends Controller {

    public function __construct( Request $request ) {
        parent::__construct( $request );
    }

    protected function _initResponse() : void {
        if ( $this->_request->getMethod() === "GET" ) {
            $mdbd = MariaDBService::getInstance();
            $this->_response = 
                $mdbd->isUp() ?
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
            $this->_setMethodNotAllowedResponse();
    } // EO _initResponse(

} // EO DefaultController