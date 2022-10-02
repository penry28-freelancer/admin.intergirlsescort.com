<?php

namespace App\Http\Controllers\FE\v1;

use App\Http\Controllers\Controller;
use App\Http\Requests\Validations\FE\v1\EscortAboutRequest;
use App\Http\Resources\FE\v1\EscortResource;
use App\Repositories\Escort\EscortRepository;
use Illuminate\Http\Response;

class EscortController extends Controller
{
    private $_escortRepo;

    public function __construct(EscortRepository $escortRepo)
    {
        $this->_escortRepo = $escortRepo;
    }

    public function updateAbout(EscortAboutRequest $request, $id)
    {
        try {
            $escort = $this->_escortRepo->find($id);

            if ($escort) {
                $escort = $this->_escortRepo->updateAbout($request, $id);

                $escort->accountable()->update([
                    'name' => $request->name,
                ]);

                return $this->jsonData(new EscortResource($escort));
            }

            return $this->jsonMessage(trans('messages.not_found'), false, Response::HTTP_NOT_FOUND);
        } catch (\Exception $e) {
            return $this->jsonError($e);
        }
    }
}
