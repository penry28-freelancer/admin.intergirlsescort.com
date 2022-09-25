<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use App\Http\Requests\Validations\CMS\v1\MemberRequest;
use App\Http\Resources\CMS\v1\MemberResource;
use App\Repositories\Member\MemberRepository;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class MemberController extends Controller
{
    private $_memberRepo;

    public function __construct(MemberRepository $memberRepo)
    {
        $this->_memberRepo = $memberRepo;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        try {
            $members = $this->_memberRepo->queryList($request);

            return $this->jsonTable([
                'data'  => MemberResource::collection($members),
                'total' => ($members->toArray())['total']
            ]);
        } catch (\Exception $e) {
            return $this->jsonError($e);
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(MemberRequest $request)
    {
        try {
            $request->merge(['password' => \Hash::make($request->password)]);
            $member = $this->_memberRepo->store($request);

            $member->accountable()->create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => $request->password,
            ]);

            return $this->jsonData(new MemberResource($member), Response::HTTP_CREATED);
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
            $member = $this->_memberRepo->find($id);
            if (! empty($member)) {
                return $this->jsonData(new MemberResource($member));
            }

            return $this->jsonMessage(trans('messages.not_found'), false, Response::HTTP_NOT_FOUND);
        } catch (\Exception $e) {
            return $this->jsonError($e);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(MemberRequest $request, $id)
    {
        try {
            $member = $this->_memberRepo->update($request, $id);

            return $this->jsonData(new MemberResource($member));
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
            $member = $this->_memberRepo->find($id);
            if ($member) {
                if ($member->is_draft == config('constants.is_draft.key.is_draft')) {
                    $this->_memberRepo->destroy($id);
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
}
