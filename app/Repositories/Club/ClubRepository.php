<?php

namespace App\Repositories\Club;

use App\Repositories\EloquentRepository;
use App\Services\QueryService;
use Illuminate\Http\Request;

class ClubRepository extends EloquentRepository implements ClubRepositoryInterface
{
    public function model()
    {
        return \App\Models\Club::class;
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

    public function queryListRelation(Request $request)
    {
        $limit = $request->get('limit', config('constants.pagination.limit'));
        return $this->model
            ->with(['city.escorts', 'reviews'])
            ->withCount(['reviews'])
            ->when($request->country_id, function ($query) use ($request) {
                return $query->whereCountryId($request->country_id);
            })
            ->when($request->city_id, function ($query) use ($request) {
                return $query->whereCityId($request->city_id);
            })
            ->paginate($limit);
    }

    public function findWithRelationship($id)
    {
        return $this->model->with('country', 'city', 'clubHours')->find($id);
    }

    public function filter($query)
    {
        return $this->model
            ->with(['country', 'city', 'accountable', 'avatar'])
            ->orderBy('created_at', 'desc')
            ->withCount([
                'escorts'
            ])
            ->get()
            ->map(function ($item) {
                $item->escorts_verified_count = $item->escorts->count();
                unset($item['escorts']);
                return $item;
            })
            ->paginate(config('constants.pagination.club'));
    }
}
