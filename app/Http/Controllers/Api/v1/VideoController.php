<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use App\Http\Requests\Validations\CMS\v1\VideoRequest;
use App\Http\Resources\CMS\v1\VideoResource;
use App\Repositories\Video\VideoRepository;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class VideoController extends Controller
{
    private $_escortRepo;

    public function __construct(VideoRepository $escortRepo)
    {
        $this->_escortRepo = $escortRepo;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        try {
            $agencies = $this->_escortRepo->queryList($request);

            return $this->jsonTable([
                'data'  => VideoResource::collection($agencies),
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
    public function store(VideoRequest $request)
    {
        try {
            $escort = $this->_escortRepo->store($request);

            return $this->jsonData(new VideoResource($escort), Response::HTTP_CREATED);
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
            $escort = $this->_escortRepo->find($id);
            if (! empty($escort)) {
                return $this->jsonData(new VideoResource($escort));
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
    public function update(VideoRequest $request, $id)
    {
        try {
            $escort = $this->_escortRepo->update($request, $id);

            return $this->jsonData(new VideoResource($escort));
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
            $escort = $this->_escortRepo->find($id);
            if ($escort) {
                if ($escort->is_draft == config('constants.is_draft.key.is_draft')) {
                    $this->_escortRepo->destroy($id);
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
