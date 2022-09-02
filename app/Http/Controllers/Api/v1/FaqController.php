<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use App\Http\Requests\Validations\CMS\v1\FaqRequest;
use App\Http\Resources\CMS\v1\FaqResource;
use App\Repositories\Faq\FaqRepository;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class FaqController extends Controller
{
    private $_faqRepo;

    public function __construct(FaqRepository $faqRepo)
    {
        $this->_faqRepo = $faqRepo;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        try {
            $cities = $this->_faqRepo->queryList($request);

            return $this->jsonTable([
                'data'  => FaqResource::collection($cities),
                'total' => ($cities->toArray())['total']
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
    public function store(FaqRequest $request)
    {
        try {
            $city = $this->_faqRepo->store($request);

            return $this->jsonData(new FaqResource($city), Response::HTTP_CREATED);
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
            $city = $this->_faqRepo->find($id);
            if (! empty($city)) {
                return $this->jsonData(new FaqResource($city));
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
    public function update(FaqRequest $request, $id)
    {
        try {
            $city = $this->_faqRepo->update($request, $id);

            return $this->jsonData(new FaqResource($city));
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
            $city = $this->_faqRepo->find($id);
            if ($city) {
                if ($city->is_draft == config('constants.is_draft.key.is_draft')) {
                    $this->_faqRepo->destroy($id);
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
