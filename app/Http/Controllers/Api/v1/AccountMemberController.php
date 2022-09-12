<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use App\Http\Requests\Validations\CMS\v1\AccountMemberRequest;
use App\Http\Resources\CMS\v1\AccountMemberResource;
use App\Repositories\AccountMember\AccountMemberRepository;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class AccountMemberController extends Controller
{
    private $_accountMemberRepo;

    public function __construct(AccountMemberRepository $accountMemberRepo)
    {
        $this->_accountMemberRepo = $accountMemberRepo;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        try {
            $account_members = $this->_accountMemberRepo->queryList($request);

            return $this->jsonTable([
                'data'  => AccountMemberResource::collection($account_members),
                'total' => ($account_members->toArray())['total']
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
    public function store(AccountMemberRequest $request)
    {
        try {
            $request->merge(['password' => \Hash::make($request->password)]);
            $account_member = $this->_accountMemberRepo->store($request);

            return $this->jsonData(new AccountMemberResource($account_member), Response::HTTP_CREATED);
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
            $account_member = $this->_accountMemberRepo->find($id);
            if (! empty($account_member)) {
                return $this->jsonData(new AccountMemberResource($account_member));
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
    public function update(AccountMemberRequest $request, $id)
    {
        try {
            $account_member = $this->_accountMemberRepo->update($request, $id);

            return $this->jsonData(new AccountMemberResource($account_member));
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
            $account_member = $this->_accountMemberRepo->find($id);
            if ($account_member) {
                if ($account_member->is_draft == config('constants.is_draft.key.is_draft')) {
                    $this->_accountMemberRepo->destroy($id);
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
