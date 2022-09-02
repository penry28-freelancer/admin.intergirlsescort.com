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
            $city = $this->_escortReviewRepo->store($request);

            return $this->jsonData(new EscortReviewResource($city), Response::HTTP_CREATED);
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
            $city = $this->_escortReviewRepo->find($id);
            if (! empty($city)) {
                return $this->jsonData(new EscortReviewResource($city));
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
            $city = $this->_escortReviewRepo->update($request, $id);

            return $this->jsonData(new EscortReviewResource($city));
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
            $city = $this->_escortReviewRepo->find($id);
            if ($city) {
                if ($city->is_draft == config('constants.is_draft.key.is_draft')) {
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
}
