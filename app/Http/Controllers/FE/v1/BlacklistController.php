<?php

namespace App\Http\Controllers\FE\v1;

use App\Filters\BlackListAgencyFilter;
use App\Filters\BlacklistClientFilter;
use App\Filters\BlacklistEscortFilter;
use App\Http\Controllers\Controller;
use App\Repositories\AgencyReport\AgencyReportRepository;
use App\Repositories\ClientReport\ClientReportRepository;
use App\Repositories\EscostReport\EscostReportRepository;

class BlacklistController extends Controller
{
    private $_escostReportRepository;
    private $_agencyReportRepository;
    private $_clientReportRepository;


    public function __construct(
        EscostReportRepository $escostReportRepository,
        AgencyReportRepository $agencyReportRepository,
        ClientReportRepository $clientReportRepository
    ) {
        $this->_escostReportRepository = $escostReportRepository;
        $this->_agencyReportRepository = $agencyReportRepository;
        $this->_clientReportRepository = $clientReportRepository;
    }

    public function escort(BlacklistEscortFilter $query)
    {
        try {
            $blacklists = $this->_escostReportRepository->filter($query);

            return $this->jsonData($blacklists);
        } catch (\Exception $ex) {
            return $this->jsonError($ex->getMessage());
        }
    }

    public function agency(BlackListAgencyFilter $query)
    {
        try {
            $blacklists = $this->_agencyReportRepository->filter($query);

            return $this->jsonData($blacklists);
        } catch (\Exception $ex) {
            return $this->jsonError($ex->getMessage());
        }
    }

    public function client(BlacklistClientFilter $query)
    {
        try {
            $blacklists = $this->_clientReportRepository->filter($query);

            return $this->jsonData($blacklists);
        } catch (\Exception $ex) {
            return $this->jsonError($ex->getMessage());
        }
    }
}
