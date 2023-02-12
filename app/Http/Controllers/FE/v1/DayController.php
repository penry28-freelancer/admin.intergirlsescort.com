<?php

namespace App\Http\Controllers\FE\v1;

use App\Http\Controllers\Controller;
use App\Http\Resources\FE\v1\DayResource;
use App\Repositories\Day\DayRepository;
use Illuminate\Http\Request;

class DayController extends Controller
{
    private $_dayRepo;

    public function __construct(DayRepository $dayRepo)
    {
        $this->_dayRepo = $dayRepo;
    }

    public function getAll()
    {
        try {
            $days = $this->_dayRepo->all();
            return $this->jsonData(DayResource::collection($days));
        } catch (\Exception $e) {
            return $this->jsonError($e);
        }
    }
}
