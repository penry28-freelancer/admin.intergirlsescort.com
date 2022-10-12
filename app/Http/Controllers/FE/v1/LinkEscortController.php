<?php

namespace App\Http\Controllers\FE\v1;

use App\Filters\LinkEscortFilter;
use App\Http\Controllers\Controller;
use App\Repositories\Escort\EscortRepository;

class LinkEscortController extends Controller
{
    private $_escortRepository;

    public function __construct(EscortRepository $escortRepository)
    {
        $this->_escortRepository = $escortRepository;
    }

    public function index(LinkEscortFilter $queryFilter)
    {
        try {
            $videos = $this->_escortRepository->filterLinkEscort($queryFilter);

            return $this->jsonData($videos);
        } catch (\Exception $ex) {
            return $this->jsonError($ex->getMessage());
        }
    }
}
