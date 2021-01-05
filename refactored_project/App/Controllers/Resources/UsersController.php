<?php

namespace App\Controllers\Resources;

use App\Controllers\Resources\ResourcesController;
use App\Http\Requests\Request;
use App\Http\Responses\Json\JsonResponse;

class UsersController extends ResourcesController {

    public function __construct( Request $request )
    {
        parent::__construct( $request );
    }

    protected function _initReadAllResponse(): void {
        // TODO response that sends back count of all users and count of currently logged in users
    }

    protected function _initReadOneResponse(): void {
        // TODO
    }

}