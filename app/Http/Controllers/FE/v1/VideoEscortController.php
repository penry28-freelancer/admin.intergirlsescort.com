<?php

namespace App\Http\Controllers\FE\v1;

use App\Filters\VideoEscortFilter;
use App\Http\Controllers\Controller;
use App\Repositories\Video\VideoRepository;

class VideoEscortController extends Controller
{
    private $_videoRepository;

    public function __construct(VideoRepository $videoRepository)
    {
        $this->_videoRepository = $videoRepository;
    }

    public function index(VideoEscortFilter $queryFilter)
    {
        try {
            $videos = $this->_videoRepository->filter($queryFilter);
            return $this->jsonData($videos);
        } catch (\Exception $ex) {
            return $this->jsonError($ex->getMessage());
        }
    }

}
