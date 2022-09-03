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

        $queryService->select = ['*'];
        $queryService->columnSearch = [
            'name',
        ];

        $queryService->search    = $search;
        $queryService->ascending = $ascending;
        $queryService->withRelationship = $withRelationship;
        $queryService->orderBy   = $orderBy;

        $builder = $queryService->queryTable();
        $builder = $builder->paginate($limit);

        return $builder;
    }

    public function findWithRelationship($id)
    {
        return $this->model->with('country', 'city', 'clubHours')->find($id);
    }

    public function update(Request $request, $id)
    {
        $model = $this->model->find($id);
        $model->update($request->all());
        if ($request->input('delete_images')){
            foreach ($request->delete_images as $type => $value) {
                $model->deleteImageTypeOf($type);
            }
        }
        if ($request->hasFile('images')) {
            $dir = config('image.dir.' . $this->model->getTable()) ?: config('image.dir.default');
            foreach ($request->images as $type => $file) {
                $model->updateImage($file, $dir, $type);
            }
        }
        return $this->model->find($id);
    }

}
