<?php

namespace App\Repositories\Contact;

use App\Repositories\EloquentRepository;
use App\Services\QueryService;
use Illuminate\Http\Request;
use Carbon\Carbon;

class ContactRepository extends EloquentRepository implements ContactRepositoryInterface
{
    public function model()
    {
        return \App\Models\Contact::class;
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
        ];

        $queryService->search    = $search;
        $queryService->ascending = $ascending;
        $queryService->orderBy   = $orderBy;

        $builder = $queryService->queryTable();
        $builder = $builder->paginate($limit);

        return $builder;
    }

    public function toggleReadAt($id, $field)
    {
        $model = $this->model->find($id);
        $status = $model->$field === null ? Carbon::now() : null;
        $model->$field = $model->$field = $status;
        $model->save();
        return $status;
    }
}
