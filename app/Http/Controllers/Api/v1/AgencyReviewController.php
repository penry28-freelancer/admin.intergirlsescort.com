<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use App\Http\Requests\Validations\CMS\v1\AgencyReviewRequest;
use App\Http\Resources\CMS\v1\AgencyReviewResource;
use App\Repositories\AgencyReview\AgencyReviewRepository;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class AgencyReviewController extends Controller
{
    private $_agencyReviewRepo;

    public function __construct(AgencyReviewRepository $agencyRepo)
    {
        $this->_agencyReviewRepo = $agencyRepo;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        try {
            $agencies = $this->_agencyReviewRepo->queryList($request);

            return $this->jsonTable([
                'data'  => AgencyReviewResource::collection($agencies),
                'total' => ($agencies->toArray())['total']
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
    public function store(AgencyReviewRequest $request)
    {
        try {
            $city = $this->_agencyReviewRepo->store($request);

            return $this->jsonData(new AgencyReviewResource($city), Response::HTTP_CREATED);
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
            $city = $this->_agencyReviewRepo->find($id);
            if (! empty($city)) {
                return $this->jsonData(new AgencyReviewResource($city));
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
    public function update(AgencyReviewRequest $request, $id)
    {
        try {
            $city = $this->_agencyReviewRepo->update($request, $id);

            return $this->jsonData(new AgencyReviewResource($city));
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
            $city = $this->_agencyReviewRepo->find($id);
            if ($city) {
                if ($city->is_draft == config('constants.is_draft.key.is_draft')) {
                    $this->_agencyReviewRepo->destroy($id);
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
