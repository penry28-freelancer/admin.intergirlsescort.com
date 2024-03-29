<?php

namespace App\Traits;

trait Imageable
{
    private $_publicPath  = 'public';
    private $_storagePath = 'app/public';

	/**
	 * Check if model has an images.
	 *
	 * @return bool
	 */
	public function hasImages()
	{
		return (bool) $this->images()->count();
	}

	/**
	 * Return collection of images related to the imageable
	 *
	 * @return Illuminate\Database\Eloquent\Collection
	 */
	public function images()
    {
        return $this->morphMany(\App\Models\Image::class, 'imageable')
        ->where(function($q){
        	$q->whereNull('featured')->orWhere('featured', 0);
        })->orderBy('order', 'asc');
    }

	/**
	 * Return the image related to the imageable
	 *
	 * @return Illuminate\Database\Eloquent\Collection
	 */
	public function image()
    {
        return $this->morphOne(\App\Models\Image::class, 'imageable')->orderBy('order', 'asc');
    }

    /**
     *
     */
    public function saveImage($image, $dir, $type = null, $options = [])
    {
        $disk  = \Storage::disk();
        $size  = !empty($type) ? config('image.sizes.' . $type) : config('image.size.default');

        $imageAnalysis    = $this->analysisImage($image);
        $imageName        = $imageAnalysis->getImageName();
        $imageExtension   = $imageAnalysis->getImageExtension();
        $imagePathToStore = $imageAnalysis->getImagePathToStore();
        $saveFolder       = $this->_publicPath . '/' . $dir;

        if ($this->_checkImageExists("{$saveFolder}/{$imagePathToStore}")) {
            $imagePathToStore =  $imageName . '-' . md5(time()) . '.' . $imageExtension;
        }

        $path   = $image->storeAs($saveFolder, $imagePathToStore);
        // $source = storage_path("{$this->_storagePath}/{$dir}/{$imagePathToStore}");
        // $target = public_path("{$dir}/{$imagePathToStore}");

        // // dd($target);
        // \Image::make($source)->save($target);

        return $this->_createImage($disk->url($path), $imageName, $imageExtension, $imageAnalysis->getImageSize(), $type, $options);
    }

    private function _createImage($path, $name, $ext = '.jpeg', $size = null, $type = null, $options=[])
    {
        return $this->image()->create(array_merge([
            'name'      => $name,
            'path'      => $path,
            'extension' => $ext,
            'size'      => $size,
            'type'      => $type,
        ], $options));
    }

    public function analysisImage($image)
    {
        return new class($image)
        {
            private $image;

            public function __construct($image)
            {
                $this->image = $image;
            }

            public function getImageName()
            {
                return \Str::slug(pathinfo($this->image->getClientOriginalName(), PATHINFO_FILENAME));
            }

            public function getImageExtension()
            {
                return $this->image->getClientOriginalExtension();
            }

            public function getImageSize()
            {
                return $this->image->getSize();
            }

            public function getImagePathToStore($prefix = '')
            {
                return $prefix . $this->getImageName() . '.' . $this->getImageExtension();
            }
        };
    }

    private function _checkImageExists($imagePath)
    {
        $disk     = \Storage::disk();
        $imageURL = parse_url($imagePath, PHP_URL_PATH);
        return !!$disk->exists($imageURL);
    }

    public function backgroundImage()
    {
        return $this->morphOne(\App\Models\Image::class, 'imageable')->where('type', 'background');
    }

    public function coverImage()
    {
        return $this->morphOne(\App\Models\Image::class, 'imageable')->where('type', 'cover');
    }

    public function logoImage()
    {
        return $this->morphOne(\App\Models\Image::class, 'imageable')->where('type', 'logo');
    }

    public function faviconImage()
    {
        return $this->morphOne(\App\Models\Image::class, 'imageable')->where('type', 'favicon');
    }

    public function bannerImage()
    {
        return $this->morphOne(\App\Models\Image::class, 'imageable')->where('type', 'banner');
    }

    public function reportImage()
    {
        return $this->morphOne(\App\Models\Image::class, 'imageable')->where('type', 'report');
    }

    public function avatarImage()
    {
        return $this->morphOne(\App\Models\Image::class, 'imageable')->where('type', 'avatar');
    }

    public function listImages()
    {
        return $this->morphMany(\App\Models\Image::class, 'imageable')->where('type', 'list')->orderBy('order', 'asc');
    }

    public function deleteImageTypeOf($type)
    {
        if ($type) {
            $rel = $type . 'Image';
            if ($image = $this->$rel) {
                $this->deleteImage($image);
            }
        }
    }

    public function deleteImage($image = null)
    {
        if (! $image) {
            $image = $this->image;
        }

        if (optional($image)->path) {
            $disk = \Storage::disk();
            $disk->delete($image->path);
            return $image->delete();
        }

        return;
    }

    public function updateImage($image, $dir, $type = null)
    {
        $this->deleteImageTypeOf($type);

        return $this->saveImage($image, $dir, $type);
    }

    public function saveImgBase64($param, $folder, $options=[])
    {
        list($extension, $content) = explode(';', $param);
        $tmpExtension = explode('/', $extension);
        preg_match('/.([0-9]+) /', microtime(), $m);
        $fileName = sprintf('img%s%s.%s', date('YmdHis'), $m[1], $tmpExtension[1]);
        $content = explode(',', $content)[1];
        $storage = \Storage::disk('public');

        $checkDirectory = $storage->exists($folder);

        if (!$checkDirectory) {
            $storage->makeDirectory($folder);
        }
        $path = $folder . '/' . $fileName;
        $storage->put($path, base64_decode($content), 'public');

        return $this->_createImage('/storage/'.$path, $fileName, $tmpExtension[1], 0, "", $options);
    }
}
