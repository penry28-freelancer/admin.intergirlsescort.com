<?php

namespace App\Repositories\EscostReport;

use App\Repositories\EloquentRepository;
use App\Services\QueryService;
use Illuminate\Http\Request;
use Carbon\Carbon;

class EscostReportRepository extends EloquentRepository implements EscostReportRepositoryInterface
{
    public function model()
    {
        return \App\Models\EscostReport::class;
    }

    public function queryList(Request $request)
    {
        $limit     = $request->get('limit', config('constants.pagination.limit'));
        $search    = $request->get('search', '');
        $orderBy   = $request->get('orderBy', '');
        $ascending = $request->get('ascending', '');
        $withRelationship = $request->get('withRelationship', '');

        $queryService = new QueryService($this->model);

        $queryService->select       = ['*'];
        $queryService->columnSearch = [
            'name_of_escost',
        ];

        $queryService->search           = $search;
        $queryService->ascending        = $ascending;
        $queryService->withRelationship = $withRelationship;
        $queryService->orderBy          = $orderBy;

        $builder = $queryService->queryTable();
        $builder = $builder->paginate($limit);

        return $builder;
    }

    public function toggleVerify($id, $field)
    {
        $model = $this->model->find($id);
        $status = $model->$field === null ? Carbon::now() : null;
        $model->$field = $model->$field = $status;
        $model->save();
        return $status;
    }
}
