<?php

namespace App\Http\Controllers\FE\v1;

use App\Http\Controllers\Controller;
use App\Http\Resources\FE\v1\CurrencyResource;
use App\Repositories\Currency\CurrencyRepository;
use Illuminate\Http\Request;

class CurrencyController extends Controller
{
    private $_currencyRepo;

    public function __construct(CurrencyRepository $countryRepo)
    {
        $this->_currencyRepo = $countryRepo;
    }

    public function getAll()
    {
        try {
            $countries = $this->_currencyRepo->all();
            return $this->jsonData(CurrencyResource::collection($countries));
        } catch (\Exception $e) {
            return $this->jsonError($e);
        }
    }
}
