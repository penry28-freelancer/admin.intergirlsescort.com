<?php

namespace App\Repositories\ClubBanner;

use App\Repositories\EloquentRepository;
use App\Services\QueryService;
use Illuminate\Http\Request;

class ClubBannerRepository extends EloquentRepository implements ClubBannerRepositoryInterface
{
    public function model()
    {
        return \App\Models\ClubBanner::class;
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
            'website_url',
        ];

        $queryService->search           = $search;
        $queryService->ascending        = $ascending;
        $queryService->withRelationship = $withRelationship;
        $queryService->orderBy          = $orderBy;

        $builder = $queryService->queryTable();
        $builder = $builder->paginate($limit);

        return $builder;
    }
}
