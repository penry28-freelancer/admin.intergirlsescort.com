<?php

namespace App\Http\Controllers\FE\v1;

use App\Filters\SearchEscortFilter;
use App\Http\Controllers\Controller;
use App\Repositories\Escort\EscortRepository;

class SearchEscortController extends Controller
{
    private $_escortRepository;

    public function __construct(EscortRepository $escortRepository)
    {
        $this->_escortRepository = $escortRepository;
    }

    public function search(SearchEscortFilter $query)
    {
        try {
            $escorts = $this->_escortRepository->filterSearchEscort($query);

            return $this->jsonData($escorts);
        } catch (\Exception $ex) {
            return $this->jsonError($ex->getMessage());
        }
    }
}
