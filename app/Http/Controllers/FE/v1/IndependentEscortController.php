<?php

namespace App\Http\Controllers\FE\v1;

use App\Filters\GirlEscortFilter;
use App\Http\Controllers\Controller;
use App\Repositories\Escort\EscortRepository;
use Illuminate\Http\Request;

class IndependentEscortController extends Controller
{
    private $_escortRepository;

    public function __construct(EscortRepository $escortRepository)
    {
        $this->_escortRepository = $escortRepository;
    }

    public function index(GirlEscortFilter $filter)
    {
        try {
            $escorts = $this->_escortRepository->filterIndependentEscort($filter);

            return $this->jsonData($escorts);
        } catch (\Exception $ex) {
            return $this->jsonError($ex->getMessage());
        }
    }
}
