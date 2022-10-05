<?php

namespace App\Http\Controllers\FE\v1;

use App\Filters\BoyTransEscortFilter;
use App\Http\Controllers\Controller;
use App\Repositories\Escort\EscortRepository;
use Illuminate\Http\Request;

class BoyTransEscortController extends Controller
{
    private $_escortRepository;

    public function __construct(EscortRepository $escortRepository)
    {
        $this->_escortRepository = $escortRepository;
    }

    public function index(BoyTransEscortFilter $filter)
    {
        try {
            $escorts = $this->_escortRepository->filterBoyTransEscort($filter);

            return $this->jsonData($escorts);
        } catch (\Exception $ex) {
            return $this->jsonError($ex->getMessage());
        }
    }
}
