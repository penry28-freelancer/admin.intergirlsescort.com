<?php

namespace App\Http\Controllers\FE\v1;

use App\Http\Controllers\Controller;
use App\Http\Requests\Validations\FE\v1\EscortAboutRequest;
use App\Http\Requests\Validations\FE\v1\EscortGallaryVideoRequest;
use App\Http\Requests\Validations\FE\v1\EscortGalleryRequest;
use App\Http\Requests\Validations\FE\v1\EscortRateRequest;
use App\Http\Requests\Validations\FE\v1\EscortServiceRequest;
use App\Http\Requests\Validations\FE\v1\EscortWorkingRequest;
use App\Http\Resources\FE\v1\EscortResource;
use App\Repositories\Escort\EscortRepository;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class CreateEscortController extends Controller
{
    private $_escortRepository;

    public function __construct(EscortRepository $escortRepository)
    {
        $this->_escortRepository = $escortRepository;
    }

    public function about(EscortAboutRequest $request)
    {
        try {
            $escort = $this->_escortRepository->createAbout($request);

            return $this->jsonData(new EscortResource($escort));
        } catch (\Exception $e) {
            return $this->jsonError($e->getMessage());
        }
    }

    public function rates(EscortRateRequest $request)
    {
        $this->_appendTypeAccountCreate($request);

        if($request->available_for != 'outcall') {
            throw ValidationException::withMessages([
                'available_for' => trans('validation.available_for_valid')
            ]);
        }

        try {
            $escort = $this->_escortRepository->storeRates($request);

            return $this->jsonData(new EscortResource($escort));
        } catch (\Exception $ex) {
            return $this->jsonError($ex->getMessage());
        }
    }

    public function gallery(EscortGalleryRequest $request)
    {
        $this->_appendTypeAccountCreate($request);

        try {
            $escort = $this->_escortRepository->createGallary($request);

            return $this->jsonData(new EscortResource($escort));
        } catch (\Exception $ex) {
            return $this->jsonError($ex->getMessage());
        }
    }

    public function video(EscortGallaryVideoRequest $request)
    {
        $this->_appendTypeAccountCreate($request);

        try {
            $escort = $this->_escortRepository->createVideoGallary($request);

            return $this->jsonData(new EscortResource($escort));
        } catch (\Exception $ex) {
            return $this->jsonError($ex->getMessage());
        }
    }

    public function services(EscortServiceRequest $request)
    {
        $this->_appendTypeAccountCreate($request);

        try {
            $escort = $this->_escortRepository->storeServices($request);

            return $this->jsonData(new EscortResource($escort));
        } catch (\Exception $ex) {
            return $this->jsonError($ex->getMessage());
        }
    }

    public function working(EscortWorkingRequest $request)
    {
        $this->_appendTypeAccountCreate($request);

        try {
            $escort = $this->_escortRepository->storeWorkingDay($request);

            return $this->jsonData(new EscortResource($escort));
        } catch (\Exception $ex) {
            return $this->jsonError($ex->getMessage());
        }
    }

    private function _appendTypeAccountCreate(Request $request)
    {
        $user = $request->user();
        if($user->isAgency())
            $request->request->add([ 'agency_id' => $user->id ]);

        if($user->isClub())
            $request->request->add([ 'club_id' => $user->id ]);
    }
}
