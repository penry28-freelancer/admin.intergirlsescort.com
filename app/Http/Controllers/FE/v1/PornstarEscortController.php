<?php

namespace App\Http\Controllers\FE\v1;

use App\Filters\PornstarEscortFilter;
use App\Http\Controllers\Controller;
use App\Repositories\Escort\EscortRepository;
use Illuminate\Http\Request;

class PornstarEscortController extends Controller
{
    private $_escortRepository;

    public function __construct(EscortRepository $escortRepository)
    {
        $this->_escortRepository = $escortRepository;
    }

    public function index(PornstarEscortFilter $filter)
    {
        try {
            $escorts = $this->_escortRepository->filterPornstarEscort($filter);

            return $this->jsonData($escorts);
        } catch (\Exception $ex) {
            return $this->jsonError($ex->getMessage());
        }
    }
}
