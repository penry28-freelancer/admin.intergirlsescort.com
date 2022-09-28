<?php

namespace App\Http\Controllers\FE\v1;

use App\Http\Controllers\Controller;
use App\Http\Resources\FE\v1\AdvertiseResource;
use App\Repositories\Advertise\AdvertiseRepository;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class AdvertiseController extends Controller
{
    private $_advertiseRepo;

    public function __construct(AdvertiseRepository $advertiseRepo)
    {
        $this->_advertiseRepo = $advertiseRepo;
    }

    /**
     * List all advertises
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function index(Request $request): JsonResponse
    {
        try {
            $advertises = $this->_advertiseRepo->getAllByOrder($request);

            return $this->jsonData(AdvertiseResource::collection($advertises));
        } catch (\Exception $e) {
            return $this->jsonError($e);
        }
    }
}
