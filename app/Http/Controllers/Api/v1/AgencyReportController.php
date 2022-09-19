<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use App\Http\Resources\CMS\v1\AgencyReportResource;
use App\Repositories\AgencyReport\AgencyReportRepository;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class AgencyReportController extends Controller
{
    private $_agencyReportRepo;

    public function __construct(AgencyReportRepository $agencyReportRepo)
    {
        $this->_agencyReportRepo = $agencyReportRepo;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        try {
            $agencyReports = $this->_agencyReportRepo->queryList($request);

            return $this->jsonTable([
                'data'  => AgencyReportResource::collection($agencyReports),
                'total' => ($agencyReports->toArray())['total'],
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
            $agencyReport = $this->_agencyReportRepo->find($id);
            if (!empty($agencyReport)) {
                return $this->jsonData(new AgencyReportResource($agencyReport));
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
            $agencyReport = $this->_agencyReportRepo->find($id);
            if ($agencyReport) {
                if ($agencyReport->is_draft == config('constants.is_draft.key.is_draft')) {
                    $this->_agencyReportRepo->destroy($id);
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
            $agencyReport = $this->_agencyReportRepo->find($id);
            if (!empty($agencyReport)) {
                $status = $this->_agencyReportRepo->toggleVerify($id, 'verified_at');

                return $this->jsonData($status);
            }

            return $this->jsonMessage(trans('messages.not_found'), false, Response::HTTP_NOT_FOUND);
        } catch (\Exception $e) {
            return $this->jsonError($e);
        }
    }
}
