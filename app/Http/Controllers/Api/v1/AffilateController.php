<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use App\Http\Requests\Validations\CMS\v1\AffilateRequest;
use App\Http\Resources\CMS\v1\AffilateResource;
use App\Repositories\Affilate\AffilateRepository;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class AffilateController extends Controller
{
    private $_affilateRepo;

    public function __construct(AffilateRepository $affilateRepo)
    {
        $this->_affilateRepo = $affilateRepo;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        try {
            $affilates = $this->_affilateRepo->queryList($request);

            return $this->jsonTable([
                'data'  => AffilateResource::collection($affilates),
                'total' => ($affilates->toArray())['total']
            ]);
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
            $affilate = $this->_affilateRepo->find($id);
            if (! empty($affilate)) {
                return $this->jsonData(new AffilateResource($affilate));
            }

            return $this->jsonMessage(trans('messages.not_found'), false, Response::HTTP_NOT_FOUND);
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
            $affilate = $this->_affilateRepo->find($id);
            if ($affilate) {
                if ($affilate->is_draft == config('constants.is_draft.key.is_draft')) {
                    $this->_affilateRepo->destroy($id);
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
