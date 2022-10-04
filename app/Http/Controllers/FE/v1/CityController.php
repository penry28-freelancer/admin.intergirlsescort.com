<?php

namespace App\Http\Controllers\FE\v1;

use App\Http\Controllers\Controller;
use App\Http\Resources\FE\v1\CityResource;
use App\Repositories\City\CityRepository;

class CityController extends Controller
{
    private $_cityRepo;

    public function __construct(CityRepository $cityRepo)
    {
        $this->_cityRepo = $cityRepo;
    }

    public function getByCountry($id)
    {
        try {
            $cities = $this->_cityRepo->getByCountry($id);
            return $this->jsonData(CityResource::collection($cities));
        } catch (\Exception $e) {
            return $this->jsonError($e);
        }
    }
}
