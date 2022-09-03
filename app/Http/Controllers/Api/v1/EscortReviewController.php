<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use App\Http\Requests\CMS\v1\EscortReviewRequest;
use App\Http\Resources\CMS\v1\EscortReviewResource;
use App\Repositories\EscortReview\EscortReviewRepository;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class EscortReviewController extends Controller
{
    private $_escortReviewRepo;

    public function __construct(EscortReviewRepository $escortReviewRepo)
    {
        $this->_escortReviewRepo = $escortReviewRepo;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        try {
            $escort_reviews = $this->_escortReviewRepo->queryList($request);

            return $this->jsonTable([
                'data'  => EscortReviewResource::collection($escort_reviews),
                'total' => ($escort_reviews->toArray())['total']
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
    public function store(EscortReviewRequest $request)
    {
        try {
            $escort_review = $this->_escortReviewRepo->store($request);

            return $this->jsonData(new EscortReviewResource($escort_review), Response::HTTP_CREATED);
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
            $escort_review = $this->_escortReviewRepo->find($id);
            if (! empty($escort_review)) {
                return $this->jsonData(new EscortReviewResource($escort_review));
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
    public function update(EscortReviewRequest $request, $id)
    {
        try {
            $escort_review = $this->_escortReviewRepo->update($request, $id);

            return $this->jsonData(new EscortReviewResource($escort_review));
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
            $escort_review = $this->_escortReviewRepo->find($id);
            if ($escort_review) {
                if ($escort_review->is_draft == config('constants.is_draft.key.is_draft')) {
                    $this->_escortReviewRepo->destroy($id);
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
            $escort_review = $this->_escortReviewRepo->find($id);
            if (! empty($escort_review)) {
                $this->_escortReviewRepo->toggle($id, 'is_verified');

                return $this->jsonMessage(trans('messages.updated'), true);
            }

            return $this->jsonMessage(trans('messages.not_found'), false, Response::HTTP_NOT_FOUND);
        } catch (\Exception $e) {
            return $this->jsonError($e);
        }
    }
}
