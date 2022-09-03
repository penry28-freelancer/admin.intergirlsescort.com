<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use App\Http\Requests\Validations\CMS\v1\PageContentRequest;
use App\Http\Resources\CMS\v1\PageContentResource;
use App\Repositories\PageContent\PageContentRepository;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class PageContentController extends Controller
{
    private $_pageContentRepo;

    public function __construct(PageContentRepository $pageContentRepo)
    {
        $this->_pageContentRepo = $pageContentRepo;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        try {
            $page_contents = $this->_pageContentRepo->queryList($request);

            return $this->jsonTable([
                'data'  => PageContentResource::collection($page_contents),
                'total' => ($page_contents->toArray())['total']
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
    public function store(PageContentRequest $request)
    {
        try {
            $page_content = $this->_pageContentRepo->store($request);

            return $this->jsonData(new PageContentResource($page_content), Response::HTTP_CREATED);
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
            $page_content = $this->_pageContentRepo->find($id);
            if (! empty($page_content)) {
                return $this->jsonData(new PageContentResource($page_content));
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
    public function update(PageContentRequest $request, $id)
    {
        try {
            $page_content = $this->_pageContentRepo->update($request, $id);

            return $this->jsonData(new PageContentResource($page_content));
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
            $page_content = $this->_pageContentRepo->find($id);
            if ($page_content) {
                if ($page_content->is_draft == config('constants.is_draft.key.is_draft')) {
                    $this->_pageContentRepo->destroy($id);
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
