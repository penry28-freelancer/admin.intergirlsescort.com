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
            $agency_review = $this->_agencyReviewRepo->store($request);

            return $this->jsonData(new AgencyReviewResource($agency_review), Response::HTTP_CREATED);
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
            $agency_review = $this->_agencyReviewRepo->find($id);
            if (! empty($agency_review)) {
                return $this->jsonData(new AgencyReviewResource($agency_review));
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
            $agency_review = $this->_agencyReviewRepo->update($request, $id);

            return $this->jsonData(new AgencyReviewResource($agency_review));
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
            $agency_review = $this->_agencyReviewRepo->find($id);
            if ($agency_review) {
                if ($agency_review->is_draft == config('constants.is_draft.key.is_draft')) {
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

    public function toggleVerify($id)
    {
        try {
            $agency_review = $this->_agencyReviewRepo->find($id);
            if (! empty($agency_review)) {
                $this->_agencyReviewRepo->toggle($id, 'is_verified');

                return $this->jsonMessage(trans('messages.updated'), true);
            }

            return $this->jsonMessage(trans('messages.not_found'), false, Response::HTTP_NOT_FOUND);
        } catch (\Exception $e) {
            return $this->jsonError($e);
        }
    }
}
