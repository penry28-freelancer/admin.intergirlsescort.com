<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use App\Http\Requests\Validations\CMS\v1\AgencyRequest;
use App\Http\Resources\CMS\v1\AgencyResource;
use App\Repositories\Agency\AgencyRepository;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class AgencyController extends Controller
{
    private $_agencyRepo;

    public function __construct(AgencyRepository $agencyRepo)
    {
        $this->_agencyRepo = $agencyRepo;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        try {
            $agencies = $this->_agencyRepo->queryList($request);

            return $this->jsonTable([
                'data'  => AgencyResource::collection($agencies),
                'total' => ($agencies->toArray())['total']
            ]);
        } catch (\Exception $e) {
            return $this->jsonError($e);
        }
    }

    public function getAll()
    {
        try {
            $agencies = $this->_agencyRepo->all();
            return $this->jsonData(AgencyResource::collection($agencies));
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
    public function store(AgencyRequest $request)
    {
        try {
            $city = $this->_agencyRepo->store($request);

            return $this->jsonData(new AgencyResource($city), Response::HTTP_CREATED);
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
            $city = $this->_agencyRepo->find($id);
            if (! empty($city)) {
                return $this->jsonData(new AgencyResource($city));
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
    public function update(AgencyRequest $request, $id)
    {
        try {
            $city = $this->_agencyRepo->update($request, $id);

            return $this->jsonData(new AgencyResource($city));
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
            $city = $this->_agencyRepo->find($id);
            if ($city) {
                if ($city->is_draft == config('constants.is_draft.key.is_draft')) {
                    $this->_agencyRepo->destroy($id);
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
