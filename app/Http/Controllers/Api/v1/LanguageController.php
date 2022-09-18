<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use App\Http\Resources\CMS\v1\LanguageResource;
use App\Repositories\Language\LanguageRepository;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class LanguageController extends Controller
{
    private $_languageRepo;

    public function __construct(LanguageRepository $languageRepo)
    {
        $this->_languageRepo = $languageRepo;
    }

    public function getAll()
    {
        try {
            $languages = $this->_languageRepo->all();
            return $this->jsonData(LanguageResource::collection($languages));
        } catch (\Exception $e) {
            return $this->jsonError($e);
        }
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        try {
            $languages = $this->_languageRepo->queryList($request);

            return $this->jsonTable([
                'data'  => LanguageResource::collection($languages),
                'total' => ($languages->toArray())['total']
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
            $language = $this->_languageRepo->find($id);
            if (! empty($language)) {
                return $this->jsonData(new LanguageResource($language));
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
            $language = $this->_languageRepo->find($id);
            if ($language) {
                if ($language->is_draft == config('constants.is_draft.key.is_draft')) {
                    $this->_languageRepo->destroy($id);
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
