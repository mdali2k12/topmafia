<?php

namespace App\Controllers\Resources;

use App\Database\BannedIPsDAO;
use App\Http\Responses\Json\JsonResponse;

class BannedIPsController extends ResourcesController {

    private BannedIPsDAO $_bipdao;

    public function __construct()
    {
        $this->_bipdao = new BannedIPsDAO();
    }

    protected function _initCreateOneResponse(): void{
        $this->_setUnauthorizedResponse();
    }
    protected function _initReadAllResponse(): void{
        $this->_setUnauthorizedResponse();
    }
    protected function _initReadOneResponse(): void{
        $this->_setUnauthorizedResponse();
    }
    protected function _initUpdateOneResponse(): void
    {
        $this->_setUnauthorizedResponse();
    }

    public function ipIsBanned( $ip ) : bool {
        return $this->_bipdao->exists( $ip );
    }

    public function setBannedIpResponseAndExit() : void {
        $this->_response = new JsonResponse( 401, ["Your IP has been banned"], false );
        exit;
    }

}