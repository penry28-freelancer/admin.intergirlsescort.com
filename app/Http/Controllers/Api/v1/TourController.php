<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use App\Http\Requests\Validations\CMS\v1\TourRequest;
use App\Http\Resources\CMS\v1\TourResource;
use App\Repositories\Tour\TourRepository;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class TourController extends Controller
{
    private $_tourRepo;

    public function __construct(TourRepository $tourRepo)
    {
        $this->_tourRepo = $tourRepo;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        try {
            $tours = $this->_tourRepo->queryList($request);

            return $this->jsonTable([
                'data'  => TourResource::collection($tours),
                'total' => ($tours->toArray())['total']
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
    public function store(TourRequest $request)
    {
        try {
            $tour = $this->_tourRepo->store($request);

            return $this->jsonData(new TourResource($tour), Response::HTTP_CREATED);
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
            $tour = $this->_tourRepo->find($id);
            if (! empty($tour)) {
                return $this->jsonData(new TourResource($tour));
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
    public function update(TourRequest $request, $id)
    {
        try {
            $tour = $this->_tourRepo->update($request, $id);

            return $this->jsonData(new TourResource($tour));
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
            $tour = $this->_tourRepo->find($id);
            if ($tour) {
                if ($tour->is_draft == config('constants.is_draft.key.is_draft')) {
                    $this->_tourRepo->destroy($id);
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
