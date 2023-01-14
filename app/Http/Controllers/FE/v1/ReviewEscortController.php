<?php

namespace App\Http\Controllers\FE\v1;

use App\Filters\ReviewEscortFilter;
use App\Http\Controllers\Controller;
use App\Repositories\Review\ReviewRepository;
use Illuminate\Http\Request;

class ReviewEscortController extends Controller
{
    private $_reviewRepository;

    public function __construct(ReviewRepository $reviewRepository)
    {
        $this->_reviewRepository = $reviewRepository;
    }

    public function index(ReviewEscortFilter $query)
    {
        try {
            $reviews = $this->_reviewRepository->filter($query);
            return $this->jsonData($reviews);
        } catch (\Exception $ex) {
            return $this->jsonError($ex->getMessage());
        }
    }
}
