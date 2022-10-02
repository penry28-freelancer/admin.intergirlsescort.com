<?php

namespace App\Http\Controllers\FE\v1;

use App\Http\Controllers\Controller;
use App\Http\Requests\Validations\FE\v1\FormReportRequest;
use App\Http\Resources\CMS\v1\ReportResource;
use App\Repositories\Report\ReportRepository;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class ReportController extends Controller
{
    private $_reportRepository;

    public function __construct(ReportRepository $reportRepository)
    {
        $this->_reportRepository = $reportRepository;
    }

    /**
     * Store a new form report
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(FormReportRequest $request)
    {
        try {
            $report = $this->_reportRepository->store($request);

            return $this->jsonData(new ReportResource($report), Response::HTTP_CREATED);
        } catch (\Exception $e) {
            return $this->jsonError($e);
        }
    }
}
