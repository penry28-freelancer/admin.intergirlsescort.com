<?php

namespace App\Repositories\Escort;

use App\Repositories\Country\CountryRepository;
use App\Repositories\EloquentRepository;
use App\Repositories\Language\LanguageRepository;
use App\Repositories\Service\ServiceRepository;
use App\Services\QueryService;
use App\Services\VideoUploader;
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

        $model->update($request->all());
        if ($request->input('delete_images')) {
            foreach ($request->delete_images as $type => $value) {
                $model->deleteImageTypeOf($type);
            }
        }

        if ($request->media) {
            $dir = config('image.dir.' . $this->model->getTable()) ?: config('image.dir.default');
            foreach ($request->media as $type => $items) {
                foreach ($items as $file) {
                    $model->updateImage($file, $dir, $type);
                }
            }
        }
        if ($request->has('video')) {
            $videoInfo = (new VideoUploader())->upload(
                $request->file('video'),
                $this->model->getTable()
            );

            $model->videoInfo()->where('escort_id', $model->id)->delete();
            $model->videoInfo()->create([
                'path' => $videoInfo->getPathname(),
                'name' => $videoInfo->getFileName(),
                'type' => $videoInfo->getExtension()
            ]);
        }

        $services = $model->services()->pluck('service_id')->toArray();

        if ($request->services) {
            // remove services belong to escort user
            $model->services()->detach($services);
            // attach escort service
            $model->services()->sync($request->services);
        }

        $working_days = $model->works()->pluck('day_id')->toArray();

        if ($request->works) {
            // remove working days belong to escort user
            $model->works()->detach($working_days);
            //
            $model->works()->sync($request->works);
        }
        return $this->model->find($id);
    }

    public function filter($escortFilter)
    {
        $escorts = null;
        $escortsPaginator = $this->model
            ->with(['services', 'country', 'languages'])
            ->withCount(['reviews'])
            ->filter($escortFilter)
            ->tap(function ($item) use (&$escorts) {
                $escorts = $item->get();
            })
            ->paginate()
            ->toArray();

        $serviceRepository = new ServiceRepository();
        $countryRepository = new CountryRepository();
        $languageRepository = new LanguageRepository();
        $serviceNames = [];
        $countryNames  = [];
        $languageNames  = [];
        $serviceRepository->all(['name'])->each(function ($item) use (&$serviceNames) {
            $serviceNames[$item->name] = 0;
        });
        $countryRepository->all(['name'])->each(function ($item) use (&$countryNames) {
            $countryNames[$item->name] = 0;
        });
        $languageRepository->all(['name'])->each(function ($item) use (&$languageNames) {
            $languageNames[$item->name] = 0;
        });
        $cloneEscort = clone $escorts;
        $services = $cloneEscort->groupBy('services.*.name')->map->count();
        $services = collect($serviceNames)->merge($services)->toArray();
        $countries = $cloneEscort->groupBy('country.name')->map->count();
        $countries = collect($countryNames)->merge($countries)->toArray();
        $languages = $cloneEscort->groupBy('languages.*.name')->map->count();
        $languages = collect($countryNames)->merge($languages)->toArray();

//        $countries = $cloneEscort->groupBy()
        $filters = [
            'age' => [
                '18-20' => 0,
                '21-25' => 0,
                '26-29' => 0,
                '30-39' => 0,
                '40-99' => 0,
            ],
            'hair' => [
                'color' => [
                    'blonde'    => 0,
                    'brown'     => 0,
                    'black'     => 0,
                    'red'       => 0,
                ],
                'length' => [
                    'short'       => 0,
                    'medium-long' => 0,
                    'long'        => 0,
                ],
                'pubic' => [
                    'shaved'    => 0,
                    'trimmed'   => 0,
                    'natural'   => 0,
                ]
            ],
            'breast' => [
                'size' => [
                    'A' => 0,
                    'B' => 0,
                    'C' => 0,
                    'D' => 0,
                    'E' => 0,
                    'F' => 0,
                    'G' => 0,
                    'H' => 0,
                ],
                'type' => [
                    'natural' => 0,
                    'silicon' => 0,
                ]
            ],
            'travel' => [
                'no'            => 0,
                'countrywide'   => 0,
                'Europe'        => 0,
                'Worldwide'     => 0,
            ],
            'weight' => [
                '45'        => 0,
                '46-50'     => 0,
                '51-55'     => 0,
                '56-60'     => 0,
                '61-65'     => 0,
                '66-70'     => 0,
                '71-90'     => 0,
                '91-110'    => 0,
                '111'       => 0,
            ],
            'height' => [
                '155'       => 0,
                '156-160'   => 0,
                '161-165'   => 0,
                '166-170'   => 0,
                '171-175'   => 0,
                '176-180'   => 0,
                '181'       => 0,
            ],
            'services' => [
                'available_for' => [
                    'incall'    => 0,
                    'outcall'   => 0,
                ],
                'services' => $services
            ],
            'eth/nat' => [
                'ethnicity' => [
                    'arabian' => 0,
                    'asian' => 0,
                    'ebony' => 0,
                    'caucasian' => 0,
                    'indian' => 0,
                    'latin' => 0,
                    'mongolia' => 0,
                    'mixed' => 0,
                ],
                'nationality' => $countries
            ],
            'languages' => $languages,
            'with_review' => 0,
            'verified' => 0,
            'newcomers' => 0,
            'with_video' => 0,
            'porn_star' => 0,
            'independent' => 0,
            'seen_last_week' => 0,
            'dou_with_girl' => 0,
            'couple' => 0,
        ];

        $escorts->each(function ($item) use (&$filters) {
            if ($item->birt_year >= 2002 && $item->birt_year <= 2004) {
                $filters['age']['18-20']++;
            } elseif ($item->birt_year >= 1997 && $item->birt_year <= 2001) {
                $filters['age']['21-25']++;
            } elseif ($item->birt_year <= 1996 && $item->birt_year >= 1993) {
                $filters['age']['26-29']++;
            } elseif ($item->birt_year <= 1992 && $item->birt_year >= 1983) {
                $filters['age']['30-39']++;
            } elseif ($item->birt_year <= 1983 && $item->birt_year >= 1900) {
                $filters['age']['40-99']++;
            }

            if ($item->hair_color == 'blonde') {
                $filters['hair']['color']['blonde']++;
            } elseif ($item->hair_color == 'brown') {
                $filters['hair']['color']['brown']++;
            } elseif ($item->hair_color == 'black') {
                $filters['hair']['color']['black']++;
            } elseif ($item->hair_color == 'red') {
                $filters['hair']['color']['red']++;
            }

            if ($item->hair_lenght == 'long') {
                $filters['hair']['length']['long']++;
            } elseif ($item->hair_lenght == 'medium-long') {
                $filters['hair']['length']['medium-long']++;
            } elseif ($item->hair_lenght == 'short') {
                $filters['hair']['length']['short']++;
            }

            if ($item->hair_pubic == 'shaved') {
                $filters['hair']['pubic']['shaved']++;
            } elseif ($item->hair_pubic == 'trimmed') {
                $filters['hair']['pubic']['trimmed']++;
            } elseif ($item->hair_pubic == 'natural') {
                $filters['hair']['pubic']['natural']++;
            }

            if ($item->bust_size == 'A') {
                $filters['breast']['size']['A']++;
            } elseif ($item->bust_size == 'B') {
                $filters['breast']['size']['B']++;
            } elseif ($item->bust_size == 'C') {
                $filters['breast']['size']['C']++;
            } elseif ($item->bust_size == 'D') {
                $filters['breast']['size']['D']++;
            } elseif ($item->bust_size == 'E') {
                $filters['breast']['size']['E']++;
            } elseif ($item->bust_size == 'F') {
                $filters['breast']['size']['F']++;
            } elseif ($item->bust_size == 'G') {
                $filters['breast']['size']['G']++;
            } else {
                $filters['breast']['size']['H']++;
            }

            if ($item->bust_type == 'natural') {
                $filters['breast']['type']['natural']++;
            } elseif ($item->bust_type == 'silicon') {
                $filters['breast']['type']['silicon']++;
            }

            if ($item->weight >= 10 && $item->weight <= 45) {
                $filters['weight']['45']++;
            } elseif ($item->weight >= 46 && $item->weight <= 50) {
                $filters['weight']['46-50']++;
            } elseif ($item->weight >= 51 && $item->weight <= 55) {
                $filters['weight']['51-55']++;
            } elseif ($item->weight >= 56 && $item->weight <= 60) {
                $filters['weight']['56-60']++;
            } elseif ($item->weight >= 61 && $item->weight <= 65) {
                $filters['weight']['61-65']++;
            } elseif ($item->weight >= 66 && $item->weight <= 70) {
                $filters['weight']['66-70']++;
            } elseif ($item->weight >= 71 && $item->weight <= 90) {
                $filters['weight']['71-90']++;
            } elseif ($item->weight >= 91 && $item->weight <= 110) {
                $filters['weight']['91-110']++;
            } elseif ($item->weight >= 110) {
                $filters['weight']['111']++;
            }

            if ($item->height <= 155) {
                $filters['height']['155']++;
            } elseif ($item->height >= 156 && $item->height <= 160) {
                $filters['height']['156-160']++;
            } elseif ($item->height >= 161 && $item->height <= 165) {
                $filters['height']['161-165']++;
            } elseif ($item->height >= 166 && $item->height <= 170) {
                $filters['height']['166-170']++;
            } elseif ($item->height >= 171 && $item->height <= 175) {
                $filters['height']['171-175']++;
            } elseif ($item->height >= 176 && $item->height <= 180) {
                $filters['height']['176-180']++;
            } elseif ($item->height >= 181) {
                $filters['height']['181']++;
            }

            if ($item->available_for == 'incall') {
                $filters['services']['available_for']['incall']++;
            } else {
                $filters['services']['available_for']['outcall']++;
            }

            if ($item->reviews_count > 0) {
                $filters['with_review']++;
            }

            if ($item->verified()) {
                $filters['verified']++;
            }

            if ($item->isNewComer()) {
                $filters['newcomers']++;
            }

            if ($item->hasVideo()) {
                $filters['with_video']++;
            }

            if ($item->isPornstar()) {
                $filters['porn_star']++;
            }

            if ($item->isIndependent()) {
                $filters['independent']++;
            }

            if($item->hasDouOfGirl()) {
                $filters['dou_with_girl']++;
            }

            if($item->hasCouple()) {
                $filters['couple']++;
            }
        });

        $filters['couple'] = $filters['couple'] / 2;
        $filters['dou_with_girl'] = $filters['dou_with_girl'] / 2;

        $escortsPaginator['filters'] = $filters;
        return $escortsPaginator;
    }
}
