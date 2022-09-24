<?php

namespace App\Repositories\Report;

use App\Repositories\EloquentRepository;
use App\Services\QueryService;
use Carbon\Carbon;
use Illuminate\Http\Request;

class ReportRepository extends EloquentRepository implements ReportRepositoryInterface
{
    public function model()
    {
        return \App\Models\Report::class;
    }

    public function queryList(Request $request)
    {
        $limit            = $request->get('limit', config('constants.pagination.limit'));
        $search           = $request->get('search', '');
        $orderBy          = $request->get('orderBy', '');
        $ascending        = $request->get('ascending', '');
        $withOrWhere      = [ $request->get('withOrWhere', '') ];
        $withRelationship = $request->get('withRelationship', '');

        $queryService = new QueryService($this->model);

        $queryService->select       = ['*'];
        $queryService->columnSearch = [
            'name',
        ];

        $queryService->search           = $search;
        $queryService->ascending        = $ascending;
        $queryService->withOrWhere      = $withOrWhere;
        $queryService->withRelationship = $withRelationship;
        $queryService->orderBy          = $orderBy;

        $builder = $queryService->queryTable();
        $builder = $builder->paginate($limit);

        return $builder;
    }

    public function toggleVerify($id, $field)
    {
        $model         = $this->model->find($id);
        $status        = $model->$field === null ? Carbon::now() : null;
        $model->$field = $model->$field = $status;
        $model->save();
        return $status;
    }
}
