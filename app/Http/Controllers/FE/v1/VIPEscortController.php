<?php

namespace App\Http\Controllers\FE\v1;

use App\Filters\VIPEscortFilter;
use App\Http\Controllers\Controller;
use App\Repositories\Escort\EscortRepository;

class VIPEscortController extends Controller
{
    private $_escortRepository;

    public function __construct(EscortRepository $escortRepository)
    {
        $this->_escortRepository = $escortRepository;
    }

    public function index(VIPEscortFilter $filter)
    {
        try {
            $escorts = $this->_escortRepository->filter($filter);

            return $this->jsonData($escorts);
        } catch (\Exception $ex) {
            return $this->jsonError($ex->getMessage());
        }
    }
}
