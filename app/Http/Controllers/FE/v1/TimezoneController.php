<?php

namespace App\Http\Controllers\FE\v1;

use App\Http\Controllers\Controller;
use App\Http\Resources\CMS\v1\TimezoneResource;
use App\Repositories\TimeZone\TimeZoneRepository;
use Illuminate\Http\Request;

class TimezoneController extends Controller
{
    private $_timeZoneRepository;

    public function __construct(TimeZoneRepository $timeZoneRepository)
    {
        $this->_timeZoneRepository = $timeZoneRepository;
    }

    public function index(Request $request)
    {
        try {
            $timezones = $this->_timeZoneRepository->all();

            return $this->jsonData(TimezoneResource::collection($timezones));
        } catch(\Exception $ex) {
            return $this->jsonError($ex->getMessage());
        }
    }
}
