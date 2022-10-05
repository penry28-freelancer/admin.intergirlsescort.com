<?php

namespace App\Http\Controllers\FE\v1;

use App\Filters\TourEscortFilter;
use App\Http\Controllers\Controller;
use App\Repositories\Tour\TourRepository;
use Illuminate\Http\Request;

class TourEscortController extends Controller
{
    private $_tourRepository;

    public function __construct(TourRepository $tourRepository)
    {
        $this->_tourRepository = $tourRepository;
    }

    public function index(TourEscortFilter $filter)
    {
        try {
            $escorts = $this->_tourRepository->filterTourEscort($filter);

            return $this->jsonData($escorts);
        } catch (\Exception $ex) {
            return $this->jsonError($ex->getMessage());
        }
    }
}
