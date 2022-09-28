<?php

namespace App\Repositories\Escort;

use App\Repositories\EloquentRepository;
use App\Services\QueryService;
use Illuminate\Http\Request;

class EscortRepository extends EloquentRepository implements EscortRepositoryInterface
{
    public function model()
    {
        return \App\Models\Escort::class;
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

    public function updateAbout(Request $request, $id)
    {
        $model = $this->model->find($id);
        // $model->update($request->all());
        // if ($request->input('delete_images')) {
        //     foreach ($request->delete_images as $type => $value) {
        //         $model->deleteImageTypeOf($type);
        //     }
        // }

        if ($request->media) {
            $dir = config('image.dir.' . $this->model->getTable()) ?: config('image.dir.default');
            foreach ($request->media as $type => $items) {
                foreach ($items as $file) {
                    $model->updateImage($file, $dir, $type);
                }
            }
        }
        return $this->model->find($id);
    }
}
