<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use App\Http\Requests\Validations\CMS\v1\ServiceRequest;
use App\Http\Resources\CMS\v1\ServiceResource;
use App\Repositories\Service\ServiceRepository;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class ServiceController extends Controller
{
    private $_serviceRepo;

    public function __construct(ServiceRepository $serviceRepo)
    {
        $this->_serviceRepo = $serviceRepo;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        try {
            $services = $this->_serviceRepo->queryList($request);

            return $this->jsonTable([
                'data'  => ServiceResource::collection($services),
                'total' => ($services->toArray())['total']
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
    public function store(ServiceRequest $request)
    {
        try {
            $service = $this->_serviceRepo->store($request);

            return $this->jsonData(new ServiceResource($service), Response::HTTP_CREATED);
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
            $service = $this->_serviceRepo->find($id);
            if (! empty($service)) {
                return $this->jsonData(new ServiceResource($service));
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
    public function update(ServiceRequest $request, $id)
    {
        try {
            $service = $this->_serviceRepo->update($request, $id);

            return $this->jsonData(new ServiceResource($service));
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
            $service = $this->_serviceRepo->find($id);
            if ($service) {
                if ($service->is_draft == config('constants.is_draft.key.is_draft')) {
                    $this->_serviceRepo->destroy($id);
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
