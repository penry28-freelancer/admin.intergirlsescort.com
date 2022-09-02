<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use App\Http\Requests\Validations\CMS\v1\CityRequest;
use App\Http\Resources\CMS\v1\CityResource;
use App\Repositories\City\CityRepository;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class CityController extends Controller
{
    private $_cityRepo;

    public function __construct(CityRepository $cityRepo)
    {
        $this->_cityRepo = $cityRepo;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        try {
            $cities = $this->_cityRepo->queryList($request);

            return $this->jsonTable([
                'data'  => CityResource::collection($cities),
                'total' => ($cities->toArray())['total']
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
    public function store(CityRequest $request)
    {
        try {
            $city = $this->_cityRepo->store($request);

            return $this->jsonData(new CityResource($city), Response::HTTP_CREATED);
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
            $city = $this->_cityRepo->find($id);
            if (! empty($city)) {
                return $this->jsonData(new CityResource($city));
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
    public function update(CityRequest $request, $id)
    {
        try {
            $city = $this->_cityRepo->update($request, $id);

            return $this->jsonData(new CityResource($city));
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
            $city = $this->_cityRepo->find($id);
            if ($city) {
                if ($city->is_draft == config('constants.is_draft.key.is_draft')) {
                    $this->_cityRepo->destroy($id);
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
