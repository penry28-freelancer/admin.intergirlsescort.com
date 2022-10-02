<?php

namespace App\Repositories\CountryGroup;

use App\Repositories\EloquentRepository;
use App\Services\QueryService;
use Illuminate\Http\Request;

class CountryGroupRepository extends EloquentRepository implements CountryGroupRepositoryInterface
{
    public function model()
    {
        return \App\Models\CountryGroup::class;
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

    /**
     * Get list country group and some info displayed on sidebar
     *
     * @param Request $request
     * @return mixed
     */
    public function getListOnSidebar(Request $request)
    {
        return $this->model
            ->with(['countries' => function ($query) {
                $query->withCount(['escorts'])
                    ->with(['cities' => function ($query) {
                        $query->withCount(['escorts'])
                            ->with(['escorts']);
                    }]);
            }])
            ->orderBy('order')
            ->get();
    }
}
