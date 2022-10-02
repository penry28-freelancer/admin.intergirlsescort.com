<?php

namespace App\Http\Controllers\FE\v1;

use App\Http\Controllers\Controller;
use App\Http\Resources\FE\v1\CountryResource;
use App\Repositories\Country\CountryRepository;

class CountryController extends Controller
{
    private $_countryRepo;

    public function __construct(CountryRepository $countryRepo)
    {
        $this->_countryRepo = $countryRepo;
    }

    public function getAll()
    {
        try {
            $countries = $this->_countryRepo->all();
            return $this->jsonData(CountryResource::collection($countries));
        } catch (\Exception $e) {
            return $this->jsonError($e);
        }
    }
}
