<?php

namespace App\Http\Controllers\FE\v1;

use App\Http\Controllers\Controller;
use App\Http\Requests\Validations\FE\v1\FormContactRequest;
use App\Http\Resources\CMS\v1\ContactResource;
use App\Repositories\Contact\ContactRepository;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class ContactController extends Controller
{
    private $_contactRepository;

    public function __construct(ContactRepository $contactRepository)
    {
        $this->_contactRepository = $contactRepository;
    }

    /**
     * Store a new form contact
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(FormContactRequest $request)
    {
        try {
            $contact = $this->_contactRepository->store($request);

            return $this->jsonData(new ContactResource($contact), Response::HTTP_CREATED);
        } catch (\Exception $e) {
            return $this->jsonError($e);
        }
    }
}
