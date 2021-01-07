<?php

namespace App\Controllers\Resources;

use App\Controllers\Resources\ResourcesController;
use App\Http\Requests\Request;
use App\Http\Responses\Json\JsonResponse;
use App\Models\User;

class UsersController extends ResourcesController {

    public function __construct( Request $request )
    {
        parent::__construct( $request );
    }

    protected function _initCreateOneResponse(): void {
        // TODO
    }

    protected function _initReadAllResponse(): void {
        $playersCount       = User::getPlayersCount();
        $onlinePlayersCount = User::getOnlinePlayersCount();
        $this->_response    = new JsonResponse( 
            200, 
            ["fetched players count", "fetched online players count"],
            true,
            [
                "playersCount"       => $playersCount,
                "onlinePlayersCount" => $onlinePlayersCount
            ]
        );
    }

    protected function _initReadOneResponse(): void {
        $this->_setUnauthorizedResponse();
    }

}