<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use App\Http\Requests\Validations\CMS\v1\ContactRequest;
use App\Http\Resources\CMS\v1\ContactResource;
use App\Repositories\Contact\ContactRepository;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class ContactController extends Controller
{
    private $_contactRepo;

    public function __construct(ContactRepository $contactRepo)
    {
        $this->_contactRepo = $contactRepo;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        try {
            $contacts = $this->_contactRepo->queryList($request);

            return $this->jsonTable([
                'data'  => ContactResource::collection($contacts),
                'total' => ($contacts->toArray())['total']
            ]);
        } catch (\Exception $e) {
            return $this->jsonError($e);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        try {
            $contact = $this->_contactRepo->find($id);
            if (! empty($contact)) {
                return $this->jsonData(new ContactResource($contact));
            }

            return $this->jsonMessage(trans('messages.not_found'), false, Response::HTTP_NOT_FOUND);
        } catch (\Exception $e) {
            return $this->jsonError($e);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            $contact = $this->_contactRepo->find($id);
            if ($contact) {
                if ($contact->is_draft == config('constants.is_draft.key.is_draft')) {
                    $this->_contactRepo->destroy($id);
                    return $this->jsonMessage(trans('messages.deleted'), true);
                } else {
                    return $this->jsonMessage(trans('messages.cant_delete'), false, Response::HTTP_NOT_ACCEPTABLE);
                }
            }

            return $this->jsonMessage(trans('messages.not_found'), false, Response::HTTP_NOT_FOUND);
        } catch (\Exception $e) {
            return $this->jsonError($e);
        }
    }

    public function toggleReadAt($id)
    {
        try {
            $contact = $this->_contactRepo->find($id);
            if (! empty($contact)) {
                $this->_contactRepo->toggleReadAt($id, 'read_at');

                return $this->jsonMessage(trans('messages.updated'), true);
            }

            return $this->jsonMessage(trans('messages.not_found'), false, Response::HTTP_NOT_FOUND);
        } catch (\Exception $e) {
            return $this->jsonError($e);
        }
    }
}
