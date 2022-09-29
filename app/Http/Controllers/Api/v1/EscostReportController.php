<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use App\Http\Resources\CMS\v1\EscostReportResource;
use App\Repositories\EscostReport\EscostReportRepository;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class EscostReportController extends Controller
{
    private $_escostReportRepo;

    public function __construct(EscostReportRepository $escostReportRepo)
    {
        $this->_escostReportRepo = $escostReportRepo;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        try {
            $escostReports = $this->_escostReportRepo->queryList($request);

            return $this->jsonTable([
                'data'  => EscostReportResource::collection($escostReports),
                'total' => ($escostReports->toArray())['total'],
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
            $escostReport = $this->_escostReportRepo->find($id);
            if (!empty($escostReport)) {
                return $this->jsonData(new EscostReportResource($escostReport));
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
            $escostReport = $this->_escostReportRepo->find($id);
            if ($escostReport) {
                if ($escostReport->is_draft == config('constants.is_draft.key.is_draft')) {
                    $this->_escostReportRepo->destroy($id);
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
            $escostReport = $this->_escostReportRepo->find($id);
            if (!empty($escostReport)) {
                $status = $this->_escostReportRepo->toggleVerify($id, 'verified_at');

                return $this->jsonData($status);
            }

            return $this->jsonMessage(trans('messages.not_found'), false, Response::HTTP_NOT_FOUND);
        } catch (\Exception $e) {
            return $this->jsonError($e);
        }
    }
}
