<?php

namespace App\Repositories\Tour;

use App\Repositories\EloquentRepository;
use App\Services\QueryService;
use Illuminate\Http\Request;

class TourRepository extends EloquentRepository implements TourRepositoryInterface
{
    public function model()
    {
        return \App\Models\Tour::class;
    }

    public function queryList(Request $request)
    {
        $limit            = $request->get('limit', config('constants.pagination.limit'));
        $search           = $request->get('search', '');
        $orderBy          = $request->get('orderBy', '');
        $ascending        = $request->get('ascending', '');
        $withRelationship = $request->get('withRelationship', '');

        $queryService = new QueryService($this->model);

        $queryService->select       = ['*'];
        $queryService->columnSearch = [
            'title',
        ];

        $queryService->search           = $search;
        $queryService->ascending        = $ascending;
        $queryService->withRelationship = $withRelationship;
        $queryService->orderBy          = $orderBy;

        $builder = $queryService->queryTable();
        $builder = $builder->paginate($limit);

        return $builder;
    }

    public function filterTourEscort($queryFilter)
    {
        return $this->model
            ->with(['escort.images', 'agency'])
            ->filter($queryFilter)
            ->tap(function ($tours) {

            })->paginate(config('constants.paginate.tour'));
    }
}
