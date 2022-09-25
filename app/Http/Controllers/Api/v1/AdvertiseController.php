<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use App\Http\Requests\Validations\CMS\v1\AdvertiseRequest;
use App\Http\Resources\CMS\v1\AdvertiseResource;
use App\Repositories\Advertise\AdvertiseRepository;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class AdvertiseController extends Controller
{
    private $_advertiseRepo;

    public function __construct(AdvertiseRepository $advertiseRepo)
    {
        $this->_advertiseRepo = $advertiseRepo;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        try {
            $advertises = $this->_advertiseRepo->queryList($request);

            return $this->jsonTable([
                'data'  => AdvertiseResource::collection($advertises),
                'total' => ($advertises->toArray())['total']
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
    public function store(AdvertiseRequest $request)
    {
        try {
            $advertise = $this->_advertiseRepo->store($request);

            return $this->jsonData(new AdvertiseResource($advertise), Response::HTTP_CREATED);
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
            $advertise = $this->_advertiseRepo->find($id);
            if (! empty($advertise)) {
                return $this->jsonData(new AdvertiseResource($advertise));
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
    public function update(AdvertiseRequest $request, $id)
    {
        try {
            $advertise = $this->_advertiseRepo->update($request, $id);

            return $this->jsonData(new AdvertiseResource($advertise));
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
            $advertise = $this->_advertiseRepo->find($id);
            if ($advertise) {
                if ($advertise->is_draft == config('constants.is_draft.key.is_draft')) {
                    $this->_advertiseRepo->destroy($id);
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
