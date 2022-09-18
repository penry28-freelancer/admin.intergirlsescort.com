<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use App\Http\Resources\CMS\v1\ClientReportResource;
use App\Repositories\ClientReport\ClientReportRepository;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class ClientReportController extends Controller
{
    private $_clientReportRepo;

    public function __construct(ClientReportRepository $clientReportRepo)
    {
        $this->_clientReportRepo = $clientReportRepo;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        try {
            $clientReports = $this->_clientReportRepo->queryList($request);

            return $this->jsonTable([
                'data'  => ClientReportResource::collection($clientReports),
                'total' => ($clientReports->toArray())['total'],
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
            $clientReport = $this->_clientReportRepo->find($id);
            if (!empty($clientReport)) {
                return $this->jsonData(new ClientReportResource($clientReport));
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
            $clientReport = $this->_clientReportRepo->find($id);
            if ($clientReport) {
                if ($clientReport->is_draft == config('constants.is_draft.key.is_draft')) {
                    $this->_clientReportRepo->destroy($id);
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

    public function toggleVerify($id)
    {
        try {
            $clientReport = $this->_clientReportRepo->find($id);
            if (!empty($clientReport)) {
                $status = $this->_clientReportRepo->toggleVerify($id, 'verified_at');

                return $this->jsonData($status);
            }

            return $this->jsonMessage(trans('messages.not_found'), false, Response::HTTP_NOT_FOUND);
        } catch (\Exception $e) {
            return $this->jsonError($e);
        }
    }
}
