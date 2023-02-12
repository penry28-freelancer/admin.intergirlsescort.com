<?php

namespace App\Http\Controllers\FE\v1;

use App\Http\Controllers\Controller;
use App\Http\Resources\FE\v1\ServiceResource;
use App\Repositories\Service\ServiceRepository;
use Illuminate\Http\Request;

class ServiceController extends Controller
{
    private $_serviceRepo;

    public function __construct(ServiceRepository $serviceRepo)
    {
        $this->_serviceRepo = $serviceRepo;
    }

    public function getAll()
    {
        try {
            $services = $this->_serviceRepo->all();
            return $this->jsonData(ServiceResource::collection($services));
        } catch (\Exception $e) {
            return $this->jsonError($e);
        }
    }
}
