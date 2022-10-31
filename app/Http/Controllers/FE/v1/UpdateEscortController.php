<?php

namespace App\Http\Controllers\FE\v1;

use App\Http\Controllers\Controller;
use App\Http\Requests\Validations\FE\v1\EscortAboutBannerRequest;
use App\Http\Requests\Validations\FE\v1\EscortAboutRequest;
use App\Http\Requests\Validations\FE\v1\EscortGalleryRequest;
use App\Http\Requests\Validations\FE\v1\EscortRateRequest;
use App\Http\Requests\Validations\FE\v1\EscortServiceRequest;
use App\Http\Requests\Validations\FE\v1\EscortWorkingRequest;
use App\Http\Resources\FE\v1\EscortResource;
use App\Repositories\Escort\EscortRepository;
use App\Transformers\EscortTransformer;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use League\Fractal\Manager;
use League\Fractal\Resource\Item;

class UpdateEscortController extends Controller
{
    private $_escortRepository;
    private $_escortTransformer;
    private $_fractal;

    public function __construct(
        EscortRepository $escortRepository,
        Manager $fractal,
        EscortTransformer $escortTransformer
    ) {
        $this->_escortRepository = $escortRepository;
        $this->_escortTransformer = $escortTransformer;
        $this->_fractal = $fractal;
    }

    public function about(EscortAboutRequest $request, $id)
    {
        try {
            $escort = $this->_escortRepository->editAbout($request, $id);
            $escort =  new Item($escort, new EscortTransformer());
            return $this->_fractal->createData($escort)->toArray();
        } catch (\Exception $ex) {
            return $this->jsonError($ex);
        }
    }

    public function banner(EscortAboutBannerRequest $request, $id)
    {
        try {
            $escort = $this->_escortRepository->editBanner($request, $id);

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

    public function video(Request $request, $id)
    {
        try {
            $escort = $this->_escortRepository->editVideo($request, $id);

            return $this->jsonData(new EscortResource($escort));
        } catch (\Exception $ex) {
            return $this->jsonError($ex);
        }
    }

    public function rates(EscortRateRequest $request, $id)
    {
        // if ($request->available_for != 'outcall') {
        //     throw ValidationException::withMessages([
        //         'available_for' => trans('validation.available_for_valid')
        //     ]);
        // }

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
            $escort = $this->_escortRepository->editService($request, $id);

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
