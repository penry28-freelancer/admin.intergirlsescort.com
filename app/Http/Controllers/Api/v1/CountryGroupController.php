<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use App\Http\Requests\Validations\CMS\v1\CountryGroupRequest;
use App\Http\Resources\CMS\v1\CountryGroupResource;
use App\Repositories\CountryGroup\CountryGroupRepository;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class CountryGroupController extends Controller
{
    private $_countryGroupRepo;

    public function __construct(CountryGroupRepository $countryGroupRepo)
    {
        $this->_countryGroupRepo = $countryGroupRepo;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        try {
            $country_groups = $this->_countryGroupRepo->queryList($request);

            return $this->jsonTable([
                'data'  => CountryGroupResource::collection($country_groups),
                'total' => ($country_groups->toArray())['total']
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
    public function store(CountryGroupRequest $request)
    {
        try {
            $country = $this->_countryGroupRepo->store($request);

            return $this->jsonData(new CountryGroupResource($country), Response::HTTP_CREATED);
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
            $country = $this->_countryGroupRepo->find($id);
            if (! empty($country)) {
                return $this->jsonData(new CountryGroupResource($country));
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
    public function update(CountryGroupRequest $request, $id)
    {
        try {
            $country = $this->_countryGroupRepo->update($request, $id);

            return $this->jsonData(new CountryGroupResource($country));
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
            $country = $this->_countryGroupRepo->find($id);
            if ($country) {
                if ($country->is_draft == config('constants.is_draft.key.is_draft')) {
                    $this->_countryGroupRepo->destroy($id);
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
