<?php

namespace App\Repositories\Agency;

use App\Repositories\EloquentRepository;
use App\Services\QueryService;
use Illuminate\Http\Request;

class AgencyRepository extends EloquentRepository implements AgencyRepositoryInterface
{
    public function model()
    {
        return \App\Models\Agency::class;
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
            'name',
        ];

        $queryService->search           = $search;
        $queryService->ascending        = $ascending;
        $queryService->withRelationship = $withRelationship;
        $queryService->orderBy          = $orderBy;

        $builder = $queryService->queryTable();
        $builder = $builder->paginate($limit);

        return $builder;
    }

    public function getAgenciesByLocation(Request $request)
    {
        $country = $request->get('country');
        $city    = $request->get('city');
        $limit   = $request->get('limit', config('constants.pagination.limit'));

        return $this->model
            ->whereHas('country', function($query) use ($country) {
                $query->where('countries.name', 'LIKE', "%{$country}%");
            })
            ->whereHas('city', function($query) use ($city) {
                $query->where('cities.name', 'LIKE', "%{$city}%");
            })->with([
                'country'   => function($query) use ($country) {
                    $query->where('countries.name', 'LIKE', "%{$country}%");
                },
                'city'      => function($query) use ($city) {
                    $query->where('cities.name', 'LIKE', "%{$city}%");
                },
                'escorts' => function($query) {
                    $query->whereHas('accountable', function ($query) {
                        return $query->where('is_verified', config('constants.verified.true'));
                    });
                }
            ])
            ->withCount([
                'escorts'
            ])
            ->get()
            ->map(function ($item) {
                $item->escorts_verified_count = $item->escorts->count();
                unset($item['escorts']);
                return $item;
            })
            ->paginate($limit);
    }
}
