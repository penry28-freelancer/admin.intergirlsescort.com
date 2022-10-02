<?php

namespace App\Repositories\Escort;

use App\Models\Service;
use App\Repositories\EloquentRepository;
use App\Services\QueryService;

use Carbon\Carbon;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use App\Services\VideoUploader;
use Symfony\Component\HttpFoundation\File\File;

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
            '',
        ];

        $queryService->search    = $search;
        $queryService->ascending = $ascending;
        $queryService->orderBy   = $orderBy;

        $builder = $queryService->queryTable();
        $builder = $builder->paginate($limit);

        return $builder;
    }

    public function storeAbout(Request $request)
    {
        //Escort
        $model = $this->model->create($request->all());
        if ($request->exists('images')) {
            foreach ($request->images as $type => $file) {
                $dir = config('image.dir.' . $this->model->getTable()) ?: config('image.dir.default');
                $base64String = $file['path'];
                $model->saveImgBase64($base64String, $dir, ['featured' => 1]);
            }
        }

        //Escort Language
        $escort_language = [];
        foreach($request->language as $key => $item) {
            $escort_language[$key]['escort_id'] = $model->id;
            $escort_language[$key]['language_id'] = $item;
            $escort_language[$key]['created_at'] = Carbon::now();
            $escort_language[$key]['updated_at'] = Carbon::now();
        }
        DB::table('escort_language')->insert($escort_language);

        return $model;
    }

    public function storeGallery(Request $request)
    {

        $model = $this->model->find($request->escort_id);
        if(!$model){
            throw new Exception("Data not found");
            return ;
        } 
        if($request->exists('video') && count($request->video) > 0) {
            $path =  'videos/' . $request->video['name'];
            Storage::disk('public')->put($path, $request->video['raw'], 'public');
            $model->update(['video' => '/storage/' . $path]);
        }
        
        if ($request->exists('photos')) {
            foreach ($request->photos as $type => $file) {
                $dir = config('image.dir.' . $this->model->getTable()) ?: config('image.dir.default');
                $base64String = $file['path'];
                $model->saveImgBase64($base64String, $dir, ['featured' => 0]);
            }
        }

        return $model;
    }

    public function storeRates(Request $request)
    {

        $model = $this->model->find($request->escort_id);
        if(!$model){
            throw new Exception("Data not found");
            return ;
        } 
        
        $escort_rates = [];
        $array_outcall = [
            'rate_outvall_30' => $request->rates['rate_30'],
            'rate_outvall_1' => $request->rates['rate_1'],
            'rate_outvall_2' => $request->rates['rate_2'],
            'rate_outvall_3' => $request->rates['rate_3'],
            'rate_outvall_6' => $request->rates['rate_6'],
            'rate_outvall_12' => $request->rates['rate_12'],
            'rate_outvall_24' => $request->rates['rate_24'],
            'rate_outvall_48' => $request->rates['rate_48'],
            'rate_outvall_24_second' => $request->rates['rate_a24'],
        ];
        $array_incall = [
            'rate_incall_30' => $request->rates['rate_30'],
            'rate_incall_1' => $request->rates['rate_1'],
            'rate_incall_2' => $request->rates['rate_2'],
            'rate_incall_3' => $request->rates['rate_3'],
            'rate_incall_6' => $request->rates['rate_6'],
            'rate_incall_12' => $request->rates['rate_12'],
            'rate_incall_24' => $request->rates['rate_24'],
            'rate_incall_48' => $request->rates['rate_48'],
            'rate_incall_24_second' => $request->rates['rate_a24'],
        ];
        if($request->available_for == 'outcall') {
            $escort_rates = $array_outcall;
        } else if($request->available_for == 'incall') {
            $escort_rates = $array_incall;
        } else {
            $escort_rates = array_merge($array_incall, $array_outcall);
        }
        $model->update(array_merge($escort_rates, ['counter_currency_id' => $request->currency]));

        return $model;
    }

    public function storeServices(Request $request)
    {

        $model = $this->model->find($request->escort_id);
        if(!$model){
            throw new Exception("Data not found");
            return ;
        } 
        
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

        return $model;
    }

    public function storeWorkingDay(Request $request)
    {

        $model = $this->model->find($request->escort_id);
        if(!$model){
            throw new Exception("Data not found");
            return ;
        } 
        
        $model->update(['timezone_id' => $request->timeZone]);
        $escort_day = [];
        foreach($request->days as $key => $item) {
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

    public function updateAbout(Request $request, $id)
    {
        $model = $this->model->find($id);
        if(!$model){
            throw new Exception("Data not found");
            return ;
        } 
        $model->accountable()->update([
            'name' => $request->name,
            'email' => $request->email,
            // 'password' => $request->password,
        ]);
        if ($request->exists('images') && $request->is_edit_image) {
            $model->images()->where('featured', 1)->delete(); //1 as default image
            foreach ($request->images as $type => $file) {
                $dir = config('image.dir.' . $this->model->getTable()) ?: config('image.dir.default');
                $base64String = $file['path'];
                $model->saveImgBase64($base64String, $dir, ['featured' => 1]);
            }
        }

        //Escort Language
        if($request->language && count($request->language) > 0) {
            $model->languages()->delete();
            $escort_language = [];
            foreach($request->language as $key => $item) {
                $escort_language[$key]['escort_id'] = $model->id;
                $escort_language[$key]['language_id'] = $item;
                $escort_language[$key]['created_at'] = Carbon::now();
                $escort_language[$key]['updated_at'] = Carbon::now();
            }
            DB::table('escort_language')->insert($escort_language);
        }

        return $model;
    }

    public function updateGallery(Request $request, $id)
    {
        $model = $this->model->find($id);
        if(!$model){
            throw new Exception("Data not found");
            return ;
        }

        if($request->exists('video') && is_array($request->video) && count($request->video) > 0) {
            $path =  'videos/' . $request->video['name'];
            Storage::disk('public')->put($path, $request->video['raw'], 'public');
            $model->update(['video' => '/storage/' . $path]);
        }
        
        if ($request->exists('photos') && $request->is_edit_image) {
            $model->images()->where('featured', 0)->delete();
            foreach ($request->photos as $type => $file) {
                $dir = config('image.dir.' . $this->model->getTable()) ?: config('image.dir.default');
                $base64String = $file['path'];
                $model->saveImgBase64($base64String, $dir, ['featured' => 0]);
            }
        }

        return $model;
    }

    public function updateRates(Request $request, $id)
    {
        $model = $this->model->find($id);
        if(!$model){
            throw new Exception("Data not found");
            return ;
        }

        $escort_rates = [];
        $array_outcall = [
            'rate_outvall_30' => $request->rates['rate_30'],
            'rate_outvall_1' => $request->rates['rate_1'],
            'rate_outvall_2' => $request->rates['rate_2'],
            'rate_outvall_3' => $request->rates['rate_3'],
            'rate_outvall_6' => $request->rates['rate_6'],
            'rate_outvall_12' => $request->rates['rate_12'],
            'rate_outvall_24' => $request->rates['rate_24'],
            'rate_outvall_48' => $request->rates['rate_48'],
            'rate_outvall_24_second' => $request->rates['rate_a24'],
        ];
        $array_incall = [
            'rate_incall_30' => $request->rates['rate_30'],
            'rate_incall_1' => $request->rates['rate_1'],
            'rate_incall_2' => $request->rates['rate_2'],
            'rate_incall_3' => $request->rates['rate_3'],
            'rate_incall_6' => $request->rates['rate_6'],
            'rate_incall_12' => $request->rates['rate_12'],
            'rate_incall_24' => $request->rates['rate_24'],
            'rate_incall_48' => $request->rates['rate_48'],
            'rate_incall_24_second' => $request->rates['rate_a24'],
        ];
        if($request->available_for == 'outcall') {
            $escort_rates = $array_outcall;
        } else if($request->available_for == 'incall') {
            $escort_rates = $array_incall;
        } else {
            $escort_rates = array_merge($array_incall, $array_outcall);
        }
        $model->update(array_merge($escort_rates, ['counter_currency_id' => $request->currency]));

        return $model;
    }

    public function updateServices(Request $request, $id)
    {
        $model = $this->model->find($id);
        if(!$model){
            throw new Exception("Data not found");
            return ;
        }

        $model->escort_service()->delete();
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

        return $model;
    }

    public function updateWorkingDay(Request $request, $id)
    {
        $model = $this->model->find($id);
        if(!$model){
            throw new Exception("Data not found");
            return ;
        }
        
        $model->escort_day()->delete();
        $model->update(['timezone_id' => $request->timeZone]);
        $escort_day = [];
        foreach($request->days as $key => $item) {
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

    // public function updateAbout(Request $request, $id)
    // {
    //     $model = $this->model->find($id);

    //     $model->update($request->all());
    //     if ($request->input('delete_images')) {
    //         foreach ($request->delete_images as $type => $value) {
    //             $model->deleteImageTypeOf($type);
    //         }
    //     }

    //     if ($request->media) {
    //         $dir = config('image.dir.' . $this->model->getTable()) ?: config('image.dir.default');
    //         foreach ($request->media as $type => $items) {
    //             foreach ($items as $file) {
    //                 $model->updateImage($file, $dir, $type);
    //             }
    //         }
    //     }  
    //     if($request->has('video')) {
    //         $videoInfo = (new VideoUploader())->upload(
    //             $request->file('video'),
    //             $this->model->getTable()
    //         );
             
    //         $model->videoInfo()->where('escort_id', $model->id)->delete();
    //         $model->videoInfo()->create([
    //             'path' => $videoInfo->getPathname(),
    //             'name' => $videoInfo->getFileName(),
    //             'type' => $videoInfo->getExtension()
    //         ]);
    //     }

    //     $services = $model->services()->pluck('service_id')->toArray();

    //     if($request->services) {
    //         // remove services belong to escort user
    //         $model->services()->detach($services);
    //         // attach escort service
    //         $model->services()->sync($request->services);
    //     }

    //     $working_days = $model->works()->pluck('day_id')->toArray();

    //     if($request->works) {
    //         // remove working days belong to escort user
    //         $model->works()->detach($working_days);
    //         //
    //         $model->works()->sync($request->works);
    //     }
    //     return $this->model->find($id);
    // }
}
