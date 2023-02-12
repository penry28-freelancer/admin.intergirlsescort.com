<?php

namespace App\Repositories\Escort;

use App\Models\Escort;
use App\Factories\EscortFactory;
use App\Services\UploadImageService;
use App\Services\UploadVideoService;
use Exception;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Services\QueryService;
use App\Services\VideoUploader;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use App\Repositories\EloquentRepository;
use App\Repositories\Country\CountryRepository;
use App\Repositories\Service\ServiceRepository;
use App\Repositories\Language\LanguageRepository;
use Illuminate\Support\Str;

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
        foreach ($request->languages as $key => $item) {
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
        if (!$model) {
            throw new Exception("Data not found");
            return ;
        }
        if ($request->exists('video') && count($request->video) > 0) {
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
        if (!$model) {
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
        if ($request->available_for == 'outcall') {
            $escort_rates = $array_outcall;
        } elseif ($request->available_for == 'incall') {
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
        if (!$model) {
            throw new Exception("Data not found");
            return ;
        }

        $escort_service = [];
        $i = 0;
        foreach ($request->services as $key => $item) {
            if ($item['checked'] == true) {
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
        if (!$model) {
            throw new Exception("Data not found");
            return ;
        }

        $model->update(['timezone' => $request->timeZone]);
        $escort_day = [];
        foreach ($request->days as $key => $item) {
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

    public function createAbout(Request $request)
    {
        $model = $this->model->create($request->all());

        $model->accountable()->create(
            $request->only(['name', 'email'])
        );

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

        //Escort Language
        if ($request->has('languages')) {
            $model->languages()->detach();
            $escort_language = [];
            foreach ($request->languages as $key => $item) {
                $escort_language[$key]['escort_id'] = $model->id;
                $escort_language[$key]['language_id'] = $item;
                $escort_language[$key]['created_at'] = Carbon::now();
                $escort_language[$key]['updated_at'] = Carbon::now();
            }

            DB::table('escort_language')->insert($escort_language);
        }

        if ($request->has('geo_country_id')) {
            $model->blockCountries()->detach();
            $model->blockCountries()->attach($request->geo_country_id);
        }

        if ($request->has('second')) {
            $second_escort = (object) $request->second;
            $second_escort_val = [
                'name'                   => !empty($second_escort->name) ? $second_escort->name : null,
                'birt_year'              => !empty($second_escort->birt_year) ? $second_escort->birt_year : null,
                'height'                 => !empty($second_escort->height) ? $second_escort->height : null,
                'weight'                 => !empty($second_escort->weight) ? $second_escort->weight : null,
                'ethnicity'              => !empty($second_escort->ethnicity) ? $second_escort->ethnicity : null,
                'hair_color'             => !empty($second_escort->hair_color) ? $second_escort->hair_color : null,
                'hair_lenght'            => !empty($second_escort->hair_lenght) ? $second_escort->hair_lenght : null,
                'bust_size'              => !empty($second_escort->bust_size) ? $second_escort->bust_size : null,
                'bust_type'              => !empty($second_escort->bust_type) ? $second_escort->bust_type : null,
                'dick_size'              => !empty($second_escort->dick_size) ? $second_escort->dick_size : null,
                'provides1'              => !empty($second_escort->provides1) ? $second_escort->provides1 : null,
                'nationality_counter_id' => !empty($second_escort->nationality_counter_id) ? $second_escort->nationality_counter_id : null,
                'travel'                 => !empty($second_escort->travel) ? $second_escort->travel : null,
                'tattoo'                 => !empty($second_escort->tattoo) ? $second_escort->tattoo : null,
                'piercing'               => !empty($second_escort->piercing) ? $second_escort->piercing : null,
                'smoker'                 => !empty($second_escort->smoker) ? $second_escort->smoker : null,
                'eye'                    => !empty($second_escort->eye) ? $second_escort->eye : null,
                'orientation'            => !empty($second_escort->orientation) ? $second_escort->orientation : null,
                'hair_pubic'             => !empty($second_escort->hair_pubic) ? $second_escort->hair_pubic : null,
            ];

            if ($model->escort) {
                $model->escort->update($second_escort_val);

                if ($second_escort->languages && count($second_escort->languages)) {
                    $model->escort->languages()->sync($second_escort->languages);
                }
            } else {
                $second_escort_val['belong_escort_id'] = $model->id;
                $second_escort_model = $this->model->create($second_escort_val);
                $second_escort_model->accountable()->create([
                    'name'        => $second_escort_val['name'],
                    'is_verified' => 1,
                ]);

                $second_escort_language = [];
                foreach ($second_escort->languages as $key => $value) {
                    $second_escort_language[$key]['escort_id']   = $second_escort_model->id;
                    $second_escort_language[$key]['language_id'] = $value;
                    $second_escort_language[$key]['created_at']  = Carbon::now();
                    $second_escort_language[$key]['updated_at']  = Carbon::now();
                }
                DB::table('escort_language')->insert($second_escort_language);
            }
        }

        return $model;
    }

    public function createGallary(Request $request)
    {
        $model = $this->model->find($request->escort_id);

        if ($request->has('photos')) {
            $dir = config('image.dir.' . $this->model->getTable()) ?: config('image.dir.default');
            foreach ($request->photos as $photo) {
                $model->saveImage($photo, $dir, null, ['featured' => 1]);
            }
        }
        return $model;
    }

    public function createVideoGallary(Request $request)
    {
        $model = $this->model->find($request->escort_id);

        if ($request->has('video')) {
            $account_id = optional($model->accountable)->id;

            $videoInfo = (new VideoUploader())->upload(
                $request->file('video'),
                $this->model->getTable()
            );

            DB::table('videos')->insert([
                'path' => $videoInfo['path'],
                'name' => $videoInfo['filename'],
                'type' => $videoInfo['extension'],
                'duration' => $videoInfo['duration'],
                'thumbnail' => $videoInfo['thumbnail'],
                'escort_id' => $model->id,
                'account_id' => $account_id,
            ]);

//            if($model->videoInfo()->count() > 0) {
//                $filePath = storage_path($videoInfo->getStoragePath() . "/" . $model->videoInfo->path);
//                if(file_exists($filePath))
//                    unlink($filePath);
//
//                $model->videoInfo->update([
//                    'path' => $videoInfo->getPathname(),
//                    'name' => $videoInfo->getFileName(),
//                    'type' => $videoInfo->getExtension(),
//                    'duration' => $videoInfo->getDuration(),
//                    'thumbnail' => $videoInfo->getThumbnail()
//                ]);
//            } else {
//                DB::table('videos')->insert([
//                    'path' => $videoInfo->getPathname(),
//                    'name' => $videoInfo->getFileName(),
//                    'type' => $videoInfo->getExtension(),
//                    'duration' => $videoInfo->getDuration(),
//                    'thumbnail' => $videoInfo->getThumbnail(),
//                    'escort_id' => $model->id,
//                    'account_id' => $account_id,
//                ]);
//            }
        }
        return $model;
    }

    public function updateAbout(Request $request, $id)
    {
        $model = $this->model->find($id);
        if (!$model) {
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
        if ($request->language && count($request->language) > 0) {
            $model->languages()->delete();
            $escort_language = [];
            foreach ($request->language as $key => $item) {
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
        if (!$model) {
            throw new Exception("Data not found");
            return ;
        }

        if ($request->exists('video') && is_array($request->video) && count($request->video) > 0) {
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
        if ($request->has('video')) {
            $videoInfo = (new VideoUploader())->upload(
                $request->file('video'),
                $this->model->getTable()
            );

            $model->videoInfo()->where('escort_id', $model->id)->delete();
            $model->videoInfo()->create([
                'path'      => $videoInfo['path'],
                'name'      => $videoInfo['filename'],
                'type'      => $videoInfo['extension'],
                'duration'  => $videoInfo['duration'],
            ]);
        }

        return $model;
    }

    public function updateRates(Request $request, $id)
    {
        $model = $this->model->find($id);
        if (!$model) {
            throw new Exception("Data not found");
            return ;
        }

        $escort_rates = [];
        $array_outcall = [
            'rate_outvall_30' => !empty($request->rates['rate_30']) ? $request->rates['rate_30'] : null,
            'rate_outvall_1' => !empty($request->rates['rate_1']) ? $request->rates['rate_1'] : null,
            'rate_outvall_2' => !empty($request->rates['rate_2']) ? $request->rates['rate_2'] : null,
            'rate_outvall_3' => !empty($request->rates['rate_3']) ? $request->rates['rate_3'] : null,
            'rate_outvall_6' => !empty($request->rates['rate_6']) ? $request->rates['rate_6'] : null,
            'rate_outvall_12' => !empty($request->rates['rate_12']) ? $request->rates['rate_12'] : null,
            'rate_outvall_24' => !empty($request->rates['rate_24']) ? $request->rates['rate_24'] : null,
            'rate_outvall_48' => !empty($request->rates['rate_48']) ? $request->rates['rate_48'] : null,
            'rate_outvall_24_second' => !empty($request->rates['rate_outvall_24_second']) ? $request->rates['rate_outvall_24_second'] : null,
        ];
        $array_incall = [
            'rate_incall_30' => !empty($request->rates['rate_30']) ? $request->rates['rate_30'] : null,
            'rate_incall_1' => !empty($request->rates['rate_1']) ? $request->rates['rate_1'] : null,
            'rate_incall_2' => !empty($request->rates['rate_2']) ? $request->rates['rate_2'] : null,
            'rate_incall_3' => !empty($request->rates['rate_3']) ? $request->rates['rate_3'] : null,
            'rate_incall_6' => !empty($request->rates['rate_6']) ? $request->rates['rate_6'] : null,
            'rate_incall_12' => !empty($request->rates['rate_12']) ? $request->rates['rate_12'] : null,
            'rate_incall_24' => !empty($request->rates['rate_24']) ? $request->rates['rate_24'] : null,
            'rate_incall_48' => !empty($request->rates['rate_48']) ? $request->rates['rate_48'] : null,
            'rate_incall_24_second' => !empty($request->rates['rate_24_second']) ? $request->rates['rate_24_second'] : null,
        ];
        if ($request->available_for == 'outcall') {
            $escort_rates = $array_outcall;
        } elseif ($request->available_for == 'incall') {
            $escort_rates = $array_incall;
        } else {
            $escort_rates = array_merge($array_incall, $array_outcall);
        }
        $model->update(array_merge($escort_rates, ['counter_currency_id' => $request->counter_currency_id]));

        return $model;
    }

    public function updateServices(Request $request, $id)
    {
        $model = $this->model->find($id);
        if (!$model) {
            throw new Exception("Data not found");
            return ;
        }

        $model->escort_service()->delete();
        $escort_service = [];
        $i = 0;
        foreach ($request->services as $key => $item) {
            if ($item['checked'] == true) {
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
        if (!$model) {
            throw new Exception("Data not found");
            return ;
        }

        $model->escort_day()->delete();
        $model->update(['timezone' => $request->timeZone]);
        $escort_day = [];
        foreach ($request->days as $key => $item) {
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

    public function editAbout(Request $request, $id)
    {
        $model = $this->model->find($id);
        $account = $model->accountable;
        $model->update($request->all());

        $model->accountable()->update([
            'name' => $request->input('name', $account->name),
            'email' => $request->input('email', $account->email)
        ]);


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

        //Escort Language
        if ($request->has('languages')) {
            $model->languages()->detach();
            $escort_language = [];
            foreach ($request->languages as $key => $item) {
                $escort_language[$key]['escort_id'] = $model->id;
                $escort_language[$key]['language_id'] = $item;
                $escort_language[$key]['created_at'] = Carbon::now();
                $escort_language[$key]['updated_at'] = Carbon::now();
            }

            DB::table('escort_language')->insert($escort_language);
        }

        if ($request->has('geo_country_id')) {
            $model->blockCountries()->detach();
            $model->blockCountries()->attach($request->geo_country_id);
        }

        if ($request->has('second')) {
            $second_escort = (object) $request->second;
            $second_escort_val = [
                'name'                   => !empty($second_escort->name) ? $second_escort->name : null,
                'birt_year'              => !empty($second_escort->birt_year) ? $second_escort->birt_year : null,
                'height'                 => !empty($second_escort->height) ? $second_escort->height : null,
                'weight'                 => !empty($second_escort->weight) ? $second_escort->weight : null,
                'ethnicity'              => !empty($second_escort->ethnicity) ? $second_escort->ethnicity : null,
                'hair_color'             => !empty($second_escort->hair_color) ? $second_escort->hair_color : null,
                'hair_lenght'            => !empty($second_escort->hair_lenght) ? $second_escort->hair_lenght : null,
                'bust_size'              => !empty($second_escort->bust_size) ? $second_escort->bust_size : null,
                'bust_type'              => !empty($second_escort->bust_type) ? $second_escort->bust_type : null,
                'dick_size'              => !empty($second_escort->dick_size) ? $second_escort->dick_size : null,
                'provides1'              => !empty($second_escort->provides1) ? $second_escort->provides1 : null,
                'nationality_counter_id' => !empty($second_escort->nationality_counter_id) ? $second_escort->nationality_counter_id : null,
                'travel'                 => !empty($second_escort->travel) ? $second_escort->travel : null,
                'tattoo'                 => !empty($second_escort->tattoo) ? $second_escort->tattoo : null,
                'piercing'               => !empty($second_escort->piercing) ? $second_escort->piercing : null,
                'smoker'                 => !empty($second_escort->smoker) ? $second_escort->smoker : null,
                'eye'                    => !empty($second_escort->eye) ? $second_escort->eye : null,
                'orientation'            => !empty($second_escort->orientation) ? $second_escort->orientation : null,
                'hair_pubic'             => !empty($second_escort->hair_pubic) ? $second_escort->hair_pubic : null,
            ];

            if ($model->escort) {
                $model->escort->update($second_escort_val);

                if ($second_escort->languages && count($second_escort->languages)) {
                    $model->escort->languages()->sync($second_escort->languages);
                }
            } else {
                $second_escort_val['belong_escort_id'] = $model->id;
                $second_escort_model = $this->model->create($second_escort_val);
                $second_escort_model->accountable()->create([
                    'name'        => $second_escort_val['name'],
                    'is_verified' => 1,
                ]);

                $second_escort_language = [];
                foreach ($second_escort->languages as $key => $value) {
                    $second_escort_language[$key]['escort_id']   = $second_escort_model->id;
                    $second_escort_language[$key]['language_id'] = $value;
                    $second_escort_language[$key]['created_at']  = Carbon::now();
                    $second_escort_language[$key]['updated_at']  = Carbon::now();
                }
                DB::table('escort_language')->insert($second_escort_language);
            }
        }

        return $model;
    }

    public function editBanner(Request $request, $id)
    {
        $model = $this->model->find($id);

        if ($request->has('banner')) {
            if ($model->banner) {
                $model->banner()->delete();
            }

            $dir = config('image.dir.' . $this->model->getTable()) ?: config('image.dir.banner');
            $model->saveImage($request->file('banner'), $dir, 'banner', ['featured' => 0 ]);
        }

        return $model;
    }

    public function editGallery(Request $request, $id)
    {
        $model = $this->model->find($id);

        if ($request->has('photos')) {
            $dir = config('image.dir.' . $this->model->getTable()) ?: config('image.dir.default');
            foreach ($request->photos as $photo) {
                $model->saveImage($photo, $dir, null, ['featured' => 0 ]);
            }
        }

        return $model;
    }

    public function editVideo(Request $request, $id)
    {
        $model = $this->model->find($id);

        if(!$model || !$request->has('video'))
            return $model;

        $account_id = optional($model->accountable)->id;

        $video = (new UploadVideoService())
            ->upload($request->file('video'), 'videos')
            ->toArray();

        $videoData = [
            'name'          => $video['name'],
            'escort_id'     => $id,
            'account_id'    => $account_id,
            'path'          => $video['path'],
            'type'          => $video['type'],
            'duration'      => $video['duration'],
            'thumbnail'     => $video['thumbnail']
        ];

        if ($model->videoInfo) {
            $filePath = public_path('storage/' . $model->videoInfo->path);
            $thumbPath = public_path('storage/' . $model->videoInfo->thumbnail);

            if (file_exists($filePath)) {
                unlink($filePath);
            }
            if (file_exists($thumbPath)) {
                unlink($thumbPath);
            }

            $model->videoInfo()->update($videoData);
        } else {
            $model->videoInfo()->create(array_merge($videoData, [
                'views' => 0
            ]));
        }

        return $model;
    }

    public function editService(Request $request, $id)
    {
        $model = $this->model->find($id);

        if ($model->escort_service) {
            $model->escort_service()->delete();
        }

        $escort_service = [];
        $date_now       = Carbon::now();

        foreach ($request->services as $item) {
            $item = (object) $item;
            $service_item = [
                'escort_id'   => (int) $id,
                'service_id'  => (int) $item->service_id,
                'is_included' => $item->is_included,
                'extra_price' => $item->extra_price,
                'created_at'  => $date_now,
                'updated_at'  => $date_now,
            ];
            $escort_service[] = $service_item;
        }

        DB::table('escort_service')->insert($escort_service);

        return $model;
    }

    public function editWorkingDay(Request $request, $id)
    {
        $model = $this->model->find($id);

        $model->update(['timezone' => $request->timezone]);
        $escort_day = [];

        $model->escort_day()->delete();
        foreach ($request->days as $key => $item) {
            $escort_day[$key]['escort_id']  = $model->id;
            $escort_day[$key]['day_id']     = $item['day_id'];
            $escort_day[$key]['from']       = $item['from'];
            $escort_day[$key]['to']         = $item['to'];
            $escort_day[$key]['all_day']    = $item['all_day'];

            $escort_day[$key]['created_at'] = Carbon::now();
            $escort_day[$key]['updated_at'] = Carbon::now();
        }
        DB::table('escort_day')->insert($escort_day);

        return $model;
    }

    public function editServices(Request $request, $id)
    {
        $model = $this->model->find($id);

        if ($request->has('services')) {
            $model->escort_service()->detach();
            $escort_service = [];
            $i = 0;
            foreach ($request->services as $service) {
                if ($service['checked'] == true) {
                    $escort_service[$i]['escort_id'] = $model->id;
                    $escort_service[$i]['created_at'] = Carbon::now();
                    $escort_service[$i]['updated_at'] = Carbon::now();
                    $escort_service[$i]['is_included'] = $service['included'];
                    $escort_service[$i]['extra_price'] = $service['extra'];
                    $escort_service[$i]['service_id'] = $service['service_id'];
                    $i++;
                }
            }
            DB::table('escort_service')->insert($escort_service);
        }
        return $model;
    }

    public function deleteImage($id, $imageId)
    {
        $model = $this->model->with(['images'])->find($id);

        if ($model->images) {
            $model->images->each(function($item) use (&$model, $imageId) {
                if($item->id == $imageId) {
                    $path = public_path($item->path);

                    if(file_exists($path)) {
                        unlink($path);
                    }

                    DB::table('images')->delete($imageId);
                }
            });
        }

        return $model;
    }
    public function filterVIPEscort($queryFilter)
    {
        $escorts = null;
        $escortsPaginator = $this->model
            ->whereHas('accountable.transactions')
            ->with(['services', 'country', 'languages', 'belongEscort', 'images', 'avatar'])
            ->withCount(['reviews', 'transactions'])
            ->filter($queryFilter)
            ->orderBy('transactions_count', 'desc')
            ->tap(function (&$item) use (&$escorts) {
                $escorts = $item->get();
            })
            ->paginate(config('constants.pagination.escort'))
            ->toArray();

        $escortsPaginator['filters'] = $this->_countRemainEscortAfterFilter($escorts);
        $escortsPaginator['data'] = $this->_makeHiddenField($escortsPaginator['data']);
        return $escortsPaginator;
    }

    public function filterGirlEscort($queryFilter)
    {
        $escorts = null;
        $escortsPaginator = $this->model
            ->with(['services', 'country', 'languages', 'belongEscort', 'images', 'avatar'])
            ->withCount(['reviews', 'transactions'])
            ->filter($queryFilter)
            ->where('sex', config('constants.sex.label.2'))
            ->orderBy('transactions_count', 'desc')
            ->tap(function ($item) use (&$escorts) {
            //    dd($item->toSql());
                $escorts = $item->get();
            })
            ->paginate(config('constants.pagination.escort'))
            ->toArray();

        $escortsPaginator['filters'] = $this->_countRemainEscortAfterFilter($escorts);
        $escortsPaginator['data'] = $this->_makeHiddenField($escortsPaginator['data']);
        return $escortsPaginator;
    }

    public function filterIndependentEscort($queryFilter)
    {
        $escorts = null;
        $escortsPaginator = $this->model
            ->with(['services', 'country', 'languages', 'belongEscort', 'images', 'avatar'])
            ->withCount(['reviews', 'transactions'])
            ->filter($queryFilter)
            ->whereNull('agency_id')
            ->whereNull('club_id')
            ->orderBy('transactions_count', 'desc')
            ->tap(function ($item) use (&$escorts) {
                $escorts = $item->get();
            })
            ->paginate(config('constants.pagination.escort'))
            ->toArray();

        $escortsPaginator['filters'] = $this->_countRemainEscortAfterFilter($escorts);
        $escortsPaginator['data'] = $this->_makeHiddenField($escortsPaginator['data']);
        return $escortsPaginator;
    }

    public function filterPornstarEscort($queryFilter)
    {
        $escorts = null;
        $escortsPaginator = $this->model
            ->with(['services', 'country', 'languages', 'belongEscort', 'images', 'avatar'])
            ->withCount(['reviews', 'transactions'])
            ->filter($queryFilter)
            ->where('pornstar', config('constants.pornstar.yes'))
            ->orderBy('transactions_count', 'desc')
            ->tap(function ($item) use (&$escorts) {
                $escorts = $item->get();
            })
            ->paginate(config('constants.pagination.escort'))
            ->toArray();

        $escortsPaginator['filters'] = $this->_countRemainEscortAfterFilter($escorts);
        $escortsPaginator['data'] = $this->_makeHiddenField($escortsPaginator['data']);
        return $escortsPaginator;
    }

    public function filterBoyTransEscort($queryFilter)
    {
        $escorts = null;
        $escortsPaginator = $this->model
            ->with(['services', 'country', 'languages', 'belongEscort', 'images', 'avatar'])
            ->withCount(['reviews', 'transactions'])
            ->filter($queryFilter)
            ->where(function ($query) {
                $query->where('sex', config('constants.sex.label.1'))
                    ->orWhere('sex', config('constants.sex.label.3'));
            })
            ->orderBy('transactions_count', 'desc')
            ->tap(function ($item) use (&$escorts) {
                $escorts = $item->get();
            })
            ->paginate(config('constants.pagination.escort'))
            ->toArray();

        $escortsPaginator['filters'] = $this->_countRemainEscortAfterFilter($escorts, true);
        $escortsPaginator['data'] = $this->_makeHiddenField($escortsPaginator['data']);
        return $escortsPaginator;
    }

    public function filterLinkEscort($queryFilter)
    {
        $escorts = null;
        $escortsPaginator = $this->model
            ->with(['services', 'country', 'languages', 'belongEscort', 'images', 'avatar'])
            ->withCount(['reviews', 'transactions'])
            ->filter($queryFilter)
            ->whereNull('agency_id')
            ->whereNull('club_id')
            ->orderBy('transactions_count', 'desc')
            ->tap(function ($item) use (&$escorts) {
                $escorts = $item->get();
            })
            ->paginate(config('constants.pagination.escort'))
            ->toArray();

        $escortsPaginator['filters'] = $this->_countRemainEscortAfterFilter($escorts);
        $escortsPaginator['data'] = $this->_makeHiddenField($escortsPaginator['data']);
        return $escortsPaginator;
    }

    // public function filterIndependentEscort($queryFilter)
    // {
    //     $escorts = null;
    //     $escortsPaginator = $this->model
    //         ->with(['services', 'country', 'languages', 'belongEscort', 'images', 'avatar'])
    //         ->withCount(['reviews', 'transactions'])
    //         ->filter($queryFilter)
    //         ->whereNull('agency_id')
    //         ->whereNull('club_id')
    //         ->orderBy('transactions_count', 'desc')
    //         ->tap(function ($item) use (&$escorts) {
    //             $escorts = $item->get();
    //         })
    //         ->paginate(config('constants.pagination.escort'))
    //         ->toArray();

    //     $escortsPaginator['filters'] = $this->_countRemainEscortAfterFilter($escorts);
    //     // dd($escortsPaginator['data'] );
    //     $escortsPaginator['data'] = array_map(function ($escort) {
    //         return EscortFactory::make($escort)->toArray();
    //     }, $escortsPaginator['data']);

    //     return $escortsPaginator;
    // }

    public function filterSearchEscort($queryFilter)
    {
        $q = $queryFilter->request->get('q');

        $escorts = null;
        $escortsPaginator = $this->model
            ->filter($queryFilter)
            ->whereHas('accountable', function ($query) use ($q) {
                $query->where('accounts.name', 'LIKE', "%$q%");
            })
            ->with(['services', 'country', 'languages', 'belongEscort', 'images', 'avatar'])
            ->withCount(['reviews', 'transactions'])
            ->orderBy('transactions_count', 'desc')
            ->tap(function ($item) use (&$escorts) {
                $escorts = $item->get();
            })
            ->paginate(config('constants.pagination.escort'))
            ->toArray();

        $escortsPaginator['filters'] = $this->_countRemainEscortAfterFilter($escorts);
        return $escortsPaginator;
    }

    private function _makeHiddenField($escortsPaginator)
    {
        return array_map(function ($escort) {
            return EscortFactory::make($escort)->toArray();
        }, $escortsPaginator);
    }

    private function _countRemainEscortAfterFilter($escorts, $withSex = false): array
    {
        $serviceRepository = new ServiceRepository();
        $countryRepository = new CountryRepository();
        $languageRepository = new LanguageRepository();
        $serviceNames = [];
        $countryNames  = [];
        $languageNames  = [];

        $serviceRepository->all(['id', 'name'])->each(function ($item) use (&$serviceNames) {
            $serviceNames[$item->name] = [
                'id' => $item->id,
                'name' => $item->name
            ];
        });
        $countryRepository->all(['id', 'name'])->each(function ($item) use (&$countryNames) {
            $countryNames[$item->name] = [
                'id' => $item->id,
                'name' => $item->name
            ];
        });
        $languageRepository->all(['id', 'name'])->each(function ($item) use (&$languageNames) {
            $languageNames[$item->name] = [
                'id' => $item->id,
                'name' => $item->name
            ];
        });

        $cloneEscort = clone $escorts;
        $services = $cloneEscort->groupBy('services.*.name')->map->count()->toArray();

        $serviceCounter = [];
        collect($serviceNames)
            ->mapWithKeys(function ($value, $key) use ($services, &$serviceCounter) {
                $serviceCounter[] = [
                    'id' => $value['id'],
                    'name' => $value['name'],
                    'value' => $services[$key] ?? 0
                ];
                return [
                    $key => $value
                ];
            });

        $countryCounter = [];
        $countries = $cloneEscort->groupBy('country.name')->map->count()->toArray();
        collect($countryNames)
            ->mapWithKeys(function ($value, $key) use ($countries, &$countryCounter) {
                $countryCounter[] = [
                    'id' => $value['id'],
                    'name' => $value['name'],
                    'value' => $countries[$key] ?? 0
                ];
                return [
                    $key => $value
                ];
            })
            ->toArray();

        $languageCounter = [];
        $languages = $cloneEscort->groupBy('languages.*.name')->map->count()->toArray();

        collect($countryNames)
            ->mapWithKeys(function ($value, $key) use ($languages, &$languageCounter) {
                $languageCounter[] = [
                    'id' => $value['id'],
                    'name' => $value['name'],
                    'value' => $languages[$key] ?? 0
                ];
                return [
                    $key => $value
                ];
            })
            ->toArray();

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
                'europe'        => 0,
                'worldwide'     => 0,
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
                'services' => $serviceCounter
            ],
            'eth_nat' => [
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
                'nationality' => $countryCounter
            ],
            'rates' => [
                30 => [
                    '0-80' => 0,
                    '81-150' => 0,
                    '151+' => 0,
                ],
                1 => [
                    '0-150' => 0,
                    '151-300' => 0,
                    '301+' => 0,
                ],
                2 => [
                    '0-350' => 0,
                    '351-500' => 0,
                    '501+' => 0,
                ],
                3 => [
                    '0-450' => 0,
                    '451-650' => 0,
                    '651+' => 0,
                ],
                6 => [
                    '0-600' => 0,
                    '601-800' => 0,
                    '801+' => 0,
                ],
                12 => [
                    '0-1000' => 0,
                    '1001-1300' => 0,
                    '1301+' => 0,
                ],
                24 => [
                    '0-1400' => 0,
                    '1401-1800' => 0,
                    '1801+' => 0,
                ],
                48 => [
                    '0-1800' => 0,
                    '1801-2200' => 0,
                    '2201+' => 0,
                ],
            ],
            'smoker' => [
                'yes' => 0,
                'no' => 0,
                'sometimes' => 0,
            ],
            'eye_color' => [
                'black' => 0,
                'blue' => 0,
                'blue_green' => 0,
                'brown' => 0,
                'green' => 0,
                'grey' => 0,
                'hazel' => 0,
            ],
            'orientation' => [
                'straight' => 0,
                'bisexual' => 0,
                'lesbian' => 0,
                'homosexual' => 0,
            ],
            'piercing' => [
                'yes' => 0,
                'no' => 0,
            ],
            'tattoo' => [
                'yes' => 0,
                'no' => 0,
            ],
            'sex' => [
                'male' => 0,
                'trans' => 0
            ],
            'languages' => $languageCounter,
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

            if (($item->rate_incall_30 > 0 && $item->rate_incall_30 <= 80) ||
                $item->rate_outvall_30 > 0 && $item->rate_outvall_30 <= 80) {
                $filters['rates'][30]['0-80']++;
            } elseif (($item->rate_incall_30 > 80 && $item->rate_incall_30 <= 150) ||
                ($item->rate_outvall_30 > 80 && $item->rate_outvall_30 <= 150)) {
                $filters['rates'][30]['81-150']++;
            } elseif ($item->rate_incall_30 > 150 || $item->rate_outvall_30 > 150) {
                $filters['rates'][30]['151+']++;
            }

            if (($item->rate_incall_1 > 0 && $item->rate_incall_1 <= 150) ||
                $item->rate_outvall_1 > 0 && $item->rate_outvall_1 <= 150) {
                $filters['rates'][1]['0-150']++;
            } elseif (($item->rate_incall_1 > 150 && $item->rate_incall_1 <= 300) ||
                ($item->rate_outvall_1 > 150 && $item->rate_outvall_1 <= 300)) {
                $filters['rates'][1]['151-300']++;
            } elseif ($item->rate_incall_1 > 300 || $item->rate_outvall_1 > 300) {
                $filters['rates'][1]['301+']++;
            }

            if (($item->rate_incall_2 > 0 && $item->rate_incall_2 <= 350) ||
                $item->rate_outvall_2 > 0 && $item->rate_outvall_2 <= 350) {
                $filters['rates'][2]['0-350']++;
            } elseif (($item->rate_incall_2 > 350 && $item->rate_incall_2 <= 500) ||
                ($item->rate_outvall_2 > 350 && $item->rate_outvall_2 <= 500)) {
                $filters['rates'][2]['351-500']++;
            } elseif ($item->rate_incall_2 > 500 || $item->rate_outvall_2 > 500) {
                $filters['rates'][2]['501+']++;
            }

            if (($item->rate_incall_3 > 0 && $item->rate_incall_3 <= 450) ||
                $item->rate_outvall_3 > 0 && $item->rate_outvall_3 <= 450) {
                $filters['rates'][3]['0-450']++;
            } elseif (($item->rate_incall_3 > 450 && $item->rate_incall_3 <= 650) ||
                ($item->rate_outvall_3 > 450 && $item->rate_outvall_3 <= 650)) {
                $filters['rates'][3]['451-650']++;
            } elseif ($item->rate_incall_3 > 650 || $item->rate_outvall_3 > 650) {
                $filters['rates'][3]['651+']++;
            }

            if (($item->rate_incall_6 > 0 && $item->rate_incall_6 <= 600) ||
                $item->rate_outvall_6 > 0 && $item->rate_outvall_6 <= 600) {
                $filters['rates'][6]['0-600']++;
            } elseif (($item->rate_incall_6 > 600 && $item->rate_incall_6 <= 800) ||
                ($item->rate_outvall_6 > 600 && $item->rate_outvall_6 <= 800)) {
                $filters['rates'][6]['601-800']++;
            } elseif ($item->rate_incall_6 > 800 || $item->rate_outvall_6 > 800) {
                $filters['rates'][6]['801+']++;
            }

            if (($item->rate_incall_12 > 0 && $item->rate_incall_12 <= 1000) ||
                $item->rate_outvall_12 > 0 && $item->rate_outvall_12 <= 1000) {
                $filters['rates'][12]['0-1000']++;
            } elseif (($item->rate_incall_12 > 1000 && $item->rate_incall_12 <= 1300) ||
                ($item->rate_outvall_12 > 1000 && $item->rate_outvall_12 <= 1300)) {
                $filters['rates'][12]['1001-1300']++;
            } elseif ($item->rate_incall_12 > 1300 || $item->rate_outvall_12 > 1300) {
                $filters['rates'][12]['1301+']++;
            }

            if (($item->rate_incall_24 > 0 && $item->rate_incall_24 <= 1400) ||
                $item->rate_outvall_24 > 0 && $item->rate_outvall_24 <= 1400) {
                $filters['rates'][24]['0-1400']++;
            } elseif (($item->rate_incall_24 > 1400 && $item->rate_incall_24 <= 1800) ||
                ($item->rate_outvall_24 > 1400 && $item->rate_outvall_24 <= 1800)) {
                $filters['rates'][24]['1401-1800']++;
            } elseif ($item->rate_incall_24 > 1800 || $item->rate_outvall_24 > 1800) {
                $filters['rates'][24]['1801+']++;
            }

            if (($item->rate_incall_2 > 0 && $item->rate_incall_2 <= 1800) ||
                $item->rate_outvall_2 > 0 && $item->rate_outvall_2 <= 1800) {
                $filters['rates'][48]['0-1800']++;
            } elseif (($item->rate_incall_2 > 1800 && $item->rate_incall_2 <= 2200) ||
                ($item->rate_outvall_2 > 1800 && $item->rate_outvall_2 <= 2200)) {
                $filters['rates'][48]['1801-2200']++;
            } elseif ($item->rate_incall_2 > 2200 || $item->rate_outvall_2 > 2200) {
                $filters['rates'][48]['2201+']++;
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

            if ($item->smoker == 'yes') {
                $filters['smoker']['yes']++;
            } elseif ($item->smoker == 'no') {
                $filters['smoker']['no']++;
            } elseif ($item->smoker == 'sometimes') {
                $filters['smoker']['sometimes']++;
            }

            if ($item->smoker == 'yes') {
                $filters['smoker']['yes']++;
            } elseif ($item->smoker == 'no') {
                $filters['smoker']['no']++;
            } elseif ($item->smoker == 'sometimes') {
                $filters['smoker']['sometimes']++;
            }

            if ($item->eye == 'black') {
                $filters['eye_color']['black']++;
            } elseif ($item->eye == 'blue') {
                $filters['eye_color']['blue']++;
            } elseif ($item->eye == 'blue_green') {
                $filters['eye_color']['blue_green']++;
            } elseif ($item->eye == 'brown') {
                $filters['eye_color']['brown']++;
            } elseif ($item->eye == 'green') {
                $filters['eye_color']['green']++;
            } elseif ($item->eye == 'grey') {
                $filters['eye_color']['grey']++;
            } elseif ($item->eye == 'hazel') {
                $filters['eye_color']['hazel']++;
            }

            if ($item->orientation == 'straight') {
                $filters['orientation']['straight']++;
            } elseif ($item->orientation == 'bisexual') {
                $filters['orientation']['bisexual']++;
            } elseif ($item->orientation == 'lesbian') {
                $filters['orientation']['lesbian']++;
            } elseif ($item->orientation == 'homosexual') {
                $filters['orientation']['homosexual']++;
            }

            if ($item->piercing == 'yes') {
                $filters['piercing']['yes']++;
            } else {
                $filters['piercing']['no']++;
            }

            if ($item->tattoo == 'yes') {
                $filters['tattoo']['yes']++;
            } else {
                $filters['tattoo']['no']++;
            }

            if ($item->available_for == 'incall') {
                $filters['services']['available_for']['incall']++;
            } else {
                $filters['services']['available_for']['outcall']++;
            }

            if ($item->sex == 'man') {
                $filters['sex']['male']++;
            } else {
                $filters['sex']['trans']++;
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

            if ($item->hasDouOfGirl()) {
                $filters['dou_with_girl']++;
            }

            if ($item->hasCouple()) {
                $filters['couple']++;
            }
        });

        $filters['couple'] = ceil($filters['couple'] / 2);
        $filters['dou_with_girl'] = ceil($filters['dou_with_girl'] / 2);

        if (!$withSex) {
            unset($filters['sex']);
        }

        return $filters;
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

    public function destroy($id)
    {
        $model = parent::destroy($id);
        // delete all languages
        // delete all avatar
        // delete all block countries
        // delete all galleries
        // delete all services
        // delete all working time
    }
}
