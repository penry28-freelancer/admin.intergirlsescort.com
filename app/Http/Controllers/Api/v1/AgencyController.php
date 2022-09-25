<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use App\Http\Requests\Validations\CMS\v1\AgencyRequest;
use App\Http\Resources\CMS\v1\AgencyResource;
use App\Repositories\Account\AccountRepository;
use App\Repositories\Agency\AgencyRepository;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class AgencyController extends Controller
{
    private $_agencyRepo;

    public function __construct(AgencyRepository $agencyRepo) {
        $this->_agencyRepo = $agencyRepo;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(Request $request)
    {
        try {
            $request->merge(['password' => \Hash::make($request->password)]);
            $agencys = $this->_agencyRepo->queryList($request);

            return $this->jsonTable([
                'data'  => AgencyResource::collection($agencys),
                'total' => ($agencys->toArray())['total']
            ]);
        } catch (\Exception $e) {
            return $this->jsonError($e);
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(AgencyRequest $request)
    {
        try {
            $request->merge(['password' => \Hash::make($request->password)]);

            $agency = $this->_agencyRepo->store($request);

            $agency->accountable()->create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => $request->password,
            ]);

            return $this->jsonData(new AgencyResource($agency), Response::HTTP_CREATED);
        } catch (\Exception $e) {
            return $this->jsonError($e);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function show($id)
    {
        try {
            $agency = $this->_agencyRepo->find($id);
            if (! empty($agency)) {
                return $this->jsonData(new AgencyResource($agency));
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
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(AgencyRequest $request, $id)
    {
        try {
            $agency = $this->_agencyRepo->update($request, $id);

            $agency->accountable->update([
                'name' => $request->name,
                'email' => $request->email,
            ]);

            return $this->jsonData(new AgencyResource($agency));
        } catch (\Exception $e) {
            return $this->jsonError($e);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy($id)
    {
        try {
            $agency = $this->_agencyRepo->find($id);
            if ($agency) {
                if ($agency->is_draft == config('constants.is_draft.key.is_draft')) {
                    $agency->accountable->delete();
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
