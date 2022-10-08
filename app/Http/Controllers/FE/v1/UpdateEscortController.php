<?php

namespace App\Http\Controllers\FE\v1;

use App\Http\Controllers\Controller;
use App\Http\Requests\Validations\FE\v1\EscortAboutRequest;
use App\Http\Requests\Validations\FE\v1\EscortGalleryRequest;
use App\Http\Requests\Validations\FE\v1\EscortRateRequest;
use App\Http\Requests\Validations\FE\v1\EscortServiceRequest;
use App\Http\Requests\Validations\FE\v1\EscortWorkingRequest;
use App\Http\Resources\FE\v1\EscortResource;
use App\Repositories\Escort\EscortRepository;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class UpdateEscortController extends Controller
{
    private $_escortRepository;

    public function __construct(EscortRepository $escortRepository)
    {
        $this->_escortRepository = $escortRepository;
    }

    public function about(EscortAboutRequest $request, $id)
    {
        try {
            $escort = $this->_escortRepository->editAbout($request, $id);

            return $this->jsonData(new EscortResource($escort));
        } catch (\Exception $ex) {
            return $this->jsonError($ex);
        }
    }

    public function gallery(EscortGalleryRequest $request, $id)
    {
        try {
            $escort = $this->_escortRepository->editGallery($request, $id);

            return $this->jsonData(new EscortResource($escort));
        } catch (\Exception $ex) {
            return $this->jsonError($ex);
        }
    }

    public function rates(EscortRateRequest $request, $id)
    {
        if($request->available_for != 'outcall') {
            throw ValidationException::withMessages([
                'available_for' => trans('validation.available_for_valid')
            ]);
        }

        try {
            $escort = $this->_escortRepository->updateRates($request, $id);

            return $this->jsonData(new EscortResource($escort));
        } catch (\Exception $ex) {
            return $this->jsonError($ex);
        }
    }

    public function services(EscortServiceRequest $request, $id)
    {
        try {
            $escort = $this->_escortRepository->updateServices($request, $id);

            return $this->jsonData(new EscortResource($escort));
        } catch (\Exception $ex) {
            return $this->jsonError($ex);
        }
    }

    public function working(EscortWorkingRequest $request, $id)
    {
        try {
            $escort = $this->_escortRepository->editWorkingDay($request, $id);

            return $this->jsonData(new EscortResource($escort));
        } catch (\Exception $ex) {
            return $this->jsonError($ex);
        }
    }
}
