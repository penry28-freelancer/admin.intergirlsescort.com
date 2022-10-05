<?php

namespace App\Repositories\Video;

use App\Repositories\EloquentRepository;
use App\Services\QueryService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class VideoRepository extends EloquentRepository implements VideoRepositoryInterface
{
    public function model()
    {
        return \App\Models\Video::class;
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

    public function filter($queryFilter)
    {
        return $this->model
            ->with([
                'escort' => function($query) {
                    $query->with([
                        'accountable' => function($subquery) {
                            $subquery->withCount('transactions');
                        }
                    ]);
                }
            ])
            ->filter($queryFilter)
            ->get()
            ->sortBy('escort.accountable.transactions_count')
            ->reverse()
            ->paginate(config('constants.pagination.video'));
    }
}
