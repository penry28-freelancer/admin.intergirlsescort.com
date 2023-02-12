<?php

namespace App\Repositories\Agency;

use App\Models\Agency;
use App\Repositories\EloquentRepository;
use App\Services\QueryService;
use App\Services\UploadImageService;
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
                },
                'accountable'
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

    public function getDetail(Agency $agency)
    {
        return $agency;
    }

    public function update(Request $request, $id)
    {
        $model = $this->model->find($id);
        $model->update($request->all());
        // if ($request->input('delete_images')) {
        //     foreach ($request->delete_images as $type => $value) {
        //         $model->deleteImageTypeOf($type);
        //     }
        // }
        // if ($request->hasFile('images')) {
        //     $dir = config('image.dir.banner');
        //     foreach ($request->images as $type => $file) {
        //         $model->updateImage($file, $dir, $type);
        //     }
        // }

        if($request->has('banner')) {
            $file = $request->file('banner');
            $imageUploaded = app(UploadImageService::class)
                ->upload($file, 'images', 'banner')
                ->toArray();

            $imageData = [
                'name'      => $imageUploaded['name'],
                'path'      => $imageUploaded['path'],
                'extension' => $imageUploaded['extension'],
                'size'      => $imageUploaded['size'],
                'type'      => $imageUploaded['type'],
            ];

            if($model->image) {
                $imagePath = public_path('storage/'. $model->image->path);
                if(file_exists($imagePath))
                    unlink($imagePath);

                $model->image()->update($imageData);
            } else {
                $model->image()->create($imageData);
            }
        }

        if($request->has('avatar')) {
            $file = $request->file('avatar');
            $imageUploaded = app(UploadImageService::class)
                ->upload($file, 'images', 'avatar')
                ->toArray();

            $imageData = [
                'name'      => $imageUploaded['name'],
                'path'      => $imageUploaded['path'],
                'extension' => $imageUploaded['extension'],
                'size'      => $imageUploaded['size'],
                'type'      => $imageUploaded['type'],
            ];

            if($model->image) {
                $imagePath = public_path('storage/'. $model->image->path);
                if(file_exists($imagePath))
                    unlink($imagePath);

                $model->image()->update($imageData);
            } else {
                $model->image()->create($imageData);
            }
        }

        return $this->model->find($id);
    }
}
