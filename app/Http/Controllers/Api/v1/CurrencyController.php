<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use App\Http\Resources\CMS\v1\CurrencyResource;
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
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try {
            return $this->getAll();
        } catch (\Exception $e) {
            return $this->jsonError($e);
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
