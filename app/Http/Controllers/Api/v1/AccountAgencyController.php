<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use App\Http\Requests\Validations\CMS\v1\AccountAgencyRequest;
use App\Http\Resources\CMS\v1\AccountAgencyResource;
use App\Repositories\AccountAgency\AccountAgencyRepository;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class AccountAgencyController extends Controller
{
    private $_accountAgencyRepo;

    public function __construct(AccountAgencyRepository $accountAgencyRepo)
    {
        $this->_accountAgencyRepo = $accountAgencyRepo;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        try {
            $account_agencys = $this->_accountAgencyRepo->queryList($request);

            return $this->jsonTable([
                'data'  => AccountAgencyResource::collection($account_agencys),
                'total' => ($account_agencys->toArray())['total']
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
    public function store(AccountAgencyRequest $request)
    {
        try {
            $account_agency = $this->_accountAgencyRepo->store($request);

            return $this->jsonData(new AccountAgencyResource($account_agency), Response::HTTP_CREATED);
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
            $account_agency = $this->_accountAgencyRepo->find($id);
            if (! empty($account_agency)) {
                return $this->jsonData(new AccountAgencyResource($account_agency));
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
    public function update(AccountAgencyRequest $request, $id)
    {
        try {
            $account_agency = $this->_accountAgencyRepo->update($request, $id);

            return $this->jsonData(new AccountAgencyResource($account_agency));
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
            $account_agency = $this->_accountAgencyRepo->find($id);
            if ($account_agency) {
                if ($account_agency->is_draft == config('constants.is_draft.key.is_draft')) {
                    $this->_accountAgencyRepo->destroy($id);
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
