<?php

namespace App\Repositories\Escort;

use App\Repositories\EloquentRepository;
use App\Services\QueryService;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

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

    public function store(Request $request)
    {
        //Escort Rates
        $escort_rates = [];
        $array_outcall = [
            'rate_outvall_30' => $request->rates['rates']['rate_30'],
            'rate_outvall_1' => $request->rates['rates']['rate_1'],
            'rate_outvall_2' => $request->rates['rates']['rate_2'],
            'rate_outvall_3' => $request->rates['rates']['rate_3'],
            'rate_outvall_6' => $request->rates['rates']['rate_6'],
            'rate_outvall_12' => $request->rates['rates']['rate_12'],
            'rate_outvall_24' => $request->rates['rates']['rate_24'],
            'rate_outvall_48' => $request->rates['rates']['rate_48'],
            'rate_outvall_24_second' => $request->rates['rates']['rate_a24'],
        ];
        $array_incall = [
            'rate_incall_30' => $request->rates['rates']['rate_30'],
            'rate_incall_1' => $request->rates['rates']['rate_1'],
            'rate_incall_2' => $request->rates['rates']['rate_2'],
            'rate_incall_3' => $request->rates['rates']['rate_3'],
            'rate_incall_6' => $request->rates['rates']['rate_6'],
            'rate_incall_12' => $request->rates['rates']['rate_12'],
            'rate_incall_24' => $request->rates['rates']['rate_24'],
            'rate_incall_48' => $request->rates['rates']['rate_48'],
            'rate_incall_24_second' => $request->rates['rates']['rate_a24'],
        ];
        if($request->about['available_for'] == 'outcall') {
            $escort_rates = $array_outcall;
        } else if($request->about['available_for'] == 'incall') {
            $escort_rates = $array_incall;
        } else {
            $escort_rates = array_merge($array_incall, $array_outcall);
        }

        //Escort
        $model = $this->model->create(array_merge($request->about, $escort_rates,[
            'timezone_id' => $request->workingTime['timeZone'],
            'counter_currency_id' => $request->rates['currency']
        ]));
        // if ($request->hasFile('images')) {
        //     foreach ($request->images as $type => $file) {
        //         $dir = config('image.dir.' . $this->model->getTable()) ?: config('image.dir.default');
        //         if (is_numeric($type)) {
        //             $model->saveImage($file, $dir);
        //         } else {
        //             $model->saveImage($file, $dir, $type);
        //         }
        //     }
        // }

        //Escort Language
        $escort_language = [];
        foreach($request->about['languages'] as $key => $item) {
            $escort_language[$key]['escort_id'] = $model->id;
            $escort_language[$key]['language_id'] = $item;
            $escort_language[$key]['created_at'] = Carbon::now();
            $escort_language[$key]['updated_at'] = Carbon::now();
        }
        DB::table('escort_language')->insert($escort_language);

        //Escort Service
        $escort_service = [];
        $i = 0;
        foreach($request->services as $key => $item) {
            if($item['checked'] == true) {
                $escort_service[$i]['escort_id'] = $model->id;
                $escort_service[$i]['created_at'] = Carbon::now();
                $escort_service[$i]['updated_at'] = Carbon::now();
                $escort_service[$i]['is_included'] = $item['included'];
                $escort_service[$i]['extra_price'] = $item['extra'];
                $escort_service[$i]['service_id'] = $item['service_id'];
                $i++;
            }
        }
        DB::table('escort_service')->insert($escort_service);

        //Escort day
        $escort_day = [];
        foreach($request->workingTime['days'] as $key => $item) {
            $escort_day[$key]['escort_id'] = $model->id;
            $escort_day[$key]['created_at'] = Carbon::now();
            $escort_day[$key]['updated_at'] = Carbon::now();
            $escort_day[$key]['name'] = $item['name'];
            $escort_day[$key]['day_id'] = $item['id'];
            $escort_day[$key]['from'] = $item['from'];
            $escort_day[$key]['to'] = $item['to'];
            $escort_day[$key]['all_day'] = $item['allday'];
        }
        DB::table('escort_day')->insert($escort_day);

        return $model;
    }

    public function findWith($id, $with = [])
	{
		return $this->model->with($with)->find($id);
	}
}
