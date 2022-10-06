<?php

namespace App\Repositories\Review;

use App\Repositories\EloquentRepository;
use App\Services\QueryService;
use Illuminate\Http\Request;

class ReviewRepository extends EloquentRepository implements ReviewRepositoryInterface
{
    public function model()
    {
        return \App\Models\EscortReview::class;
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

    public function filter($query)
    {
        return $this->model
            ->with(['escort', 'country', 'city', 'currency'])
            ->filter($query)
            ->orderBy('created_at', 'desc')
            ->paginate(config('constants.pagination.review'));
    }
}
