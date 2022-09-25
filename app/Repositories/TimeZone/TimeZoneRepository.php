<?php

namespace App\Repositories\TimeZone;

use App\Repositories\EloquentRepository;
use App\Services\QueryService;
use Illuminate\Http\Request;

class TimeZoneRepository extends EloquentRepository implements TimeZoneRepositoryInterface
{
    public function model()
    {
        return \App\Models\TimeZone::class;
    }

    public function queryList(Request $request)
    {
        $limit     = $request->get('limit', config('constants.pagination.limit'));
        $search    = $request->get('search', '');
        $orderBy   = $request->get('orderBy', '');
        $ascending = $request->get('ascending', '');

        $queryService = new QueryService($this->model);

        $queryService->select = ['*'];
        $queryService->columnSearch = [
            'name',
            'zone',
            'gmt'
        ];

        $queryService->search    = $search;
        $queryService->ascending = $ascending;
        $queryService->orderBy   = $orderBy;

        $builder = $queryService->queryTable();
        $builder = $builder->paginate($limit);

        return $builder;
    }
}
