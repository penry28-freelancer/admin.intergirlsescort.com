<?php

namespace App\Http\Controllers\FE\v1;

use App\Http\Controllers\Controller;
use App\Http\Resources\CMS\v1\AgencyResource;
use App\Http\Resources\CMS\v1\EscortResource;
use App\Models\Agency;
use App\Models\Escort;
use App\Repositories\Agency\AgencyRepository;
use Illuminate\Http\Request;

class EscortAgencyController extends Controller
{
    private $_agencyRepository;

    public function __construct(AgencyRepository $agencyRepository)
    {
        $this->_agencyRepository = $agencyRepository;
    }

    /**
     * Show list agency
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(Request $request)
    {
        try {
            $agencies = $this->_agencyRepository->getAgenciesByLocation($request);

            return $this->jsonData($agencies);
        } catch (\Exception $e) {
            return $this->jsonError($e);
        }
    }

    /**
     * Detail Escort Agency
     * @param Request $request
     * @parame Agency
     * @return \Illuminate\Http\JsonResponse
     */
    public function show(Request $request, $agency)
    {
        try {
            $agency = $this->_agencyRepository->find($agency);
            return $this->jsonData(new AgencyResource($agency));
        } catch (\Exception $e) {
            return $this->jsonError($e);
        }
    }
}
