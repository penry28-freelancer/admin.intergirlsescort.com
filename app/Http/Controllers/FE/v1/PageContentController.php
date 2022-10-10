<?php

namespace App\Http\Controllers\FE\v1;

use App\Http\Controllers\Controller;
use App\Http\Resources\FE\v1\PageContentResource;
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

    public function getAboutContent()
    {
        try {
            $aboutContent = $this->_pageContentRepo->find(config('constants.pages_content_key.about'));
            if ($aboutContent) {
                return $this->jsonData(new PageContentResource($aboutContent));
            }

            return $this->jsonMessage(trans('messages.not_found'), false, Response::HTTP_NOT_FOUND);
        } catch (\Exception $e) {
            return $this->jsonError($e);
        }
    }
}
