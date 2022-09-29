<?php

namespace App\Http\Controllers\FE\v1;

use App\Http\Controllers\Controller;
use App\Http\Resources\FE\v1\CountryGroupCollection;
use App\Http\Resources\FE\v1\CountryGroupResource;
use App\Repositories\CountryGroup\CountryGroupRepository;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class CountryGroupController extends Controller
{
    private $_countryGroupRepository;

    public function __construct(CountryGroupRepository $countryGroupRepository)
    {
        $this->_countryGroupRepository = $countryGroupRepository;
    }

    /**
     * Get list country group displayed on sidebar
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function getListOnSidebar(Request $request): JsonResponse
    {
        try {
            $country_groups = $this->_countryGroupRepository->getListOnSidebar($request);

            return $this->jsonData(CountryGroupResource::collection($country_groups));
        } catch (\Exception $e) {
            return $this->jsonError($e);
        }
    }
}
