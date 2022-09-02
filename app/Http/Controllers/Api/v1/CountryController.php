<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use App\Http\Requests\CMS\v1\CountryRequest;
use App\Http\Resources\CMS\v1\CountryResource;
use App\Repositories\Country\CountryRepository;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

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

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        try {
            $countries = $this->_countryRepo->queryList($request);

            return $this->jsonTable([
                'data'  => CountryResource::collection($countries),
                'total' => ($countries->toArray())['total']
            ]);
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
    public function store(CountryRequest $request)
    {
        try {
            $country = $this->_countryRepo->store($request);

            return $this->jsonData(new CountryResource($country), Response::HTTP_CREATED);
        } catch (\Exception $e) {
            return $this->jsonError($e);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        try {
            $country = $this->_countryRepo->find($id);
            if (! empty($country)) {
                return $this->jsonData(new CountryResource($country));
            }

            return $this->jsonMessage(trans('messages.not_found'), false, Response::HTTP_NOT_FOUND);
        } catch (\Exception $e) {
            return $this->jsonError($e);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(CountryRequest $request, $id)
    {
        try {
            $country = $this->_countryRepo->update($request, $id);

            return $this->jsonData(new CountryResource($country));
        } catch (\Exception $e) {
            return $this->jsonError($e);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            $country = $this->_countryRepo->find($id);
            if ($country) {
                if ($country->is_draft == config('constants.is_draft.key.is_draft')) {
                    $this->_countryRepo->destroy($id);
                    return $this->jsonMessage(trans('messages.deleted'), true);
                } else {
                    return $this->jsonMessage(trans('messages.cant_delete'), false, Response::HTTP_NOT_ACCEPTABLE);
                }
            }

            return $this->jsonMessage(trans('messages.not_found'), false, Response::HTTP_NOT_FOUND);
        } catch (\Exception $e) {
            return $this->jsonError($e);
        }
    }
}
