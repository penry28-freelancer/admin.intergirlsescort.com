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

class CreateEscortController extends Controller
{
    private $_escortRepository;

    public function __construct(EscortRepository $escortRepository)
    {
        $this->_escortRepository = $escortRepository;
    }

    public function store(Request $request)
    {
        $user = $request->user();
        $tab = $request->get('tab');

        if($user->isAgency() || $user->isClub()) {
            if($user->isAgency())
                $request->request->add([ 'agency_id' => $user->id ]);
            if($user->isClub())
                $request->request->add([ 'club_id' => $user->id ]);

            $acceptMethod = ['about', 'gallery', 'rates', 'services', 'working'];
            if(method_exists($this, $tab) && in_array($tab, $acceptMethod)) {
                $escort = call_user_func([$this, $tab], $request);
                return $this->jsonData(new EscortResource($escort));
            } else {
                return $this->jsonError('Tab invalid');
            }
        } else {
            return $this->jsonError('Request not accept');
        }
    }

    public function about(Request $request)
    {
        app()->make(EscortAboutRequest::class);

        try {
            return $this->_escortRepository->storeAbout($request);
        } catch (\Exception $ex) {
            return $this->jsonError($ex->getMessage());
        }
    }

    public function rates(Request $request)
    {
        app()->make(EscortRateRequest::class);

        if($request->available_for != 'outcall') {
            throw ValidationException::withMessages([
                'available_for' => trans('validation.available_for_valid')
            ]);
        }

        try {
            return $this->_escortRepository->storeRates($request);
        } catch (\Exception $ex) {
            return $this->jsonError($ex->getMessage());
        }
    }

    public function gallery(Request $request)
    {
        app()->make(EscortGalleryRequest::class);

        try {
            return $this->_escortRepository->createGallary($request);
        } catch (\Exception $ex) {
            return $this->jsonError($ex->getMessage());
        }
    }

    public function services(Request $request)
    {
        app()->make(EscortServiceRequest::class);

        try {
            return $this->_escortRepository->storeServices($request);
        } catch (\Exception $ex) {
            return $this->jsonError($ex->getMessage());
        }
    }

    public function working(Request $request)
    {
        app()->make(EscortWorkingRequest::class);

        try {
            return $this->_escortRepository->storeWorkingDay($request);
        } catch (\Exception $ex) {
            return $this->jsonError($ex->getMessage());
        }
    }
}
