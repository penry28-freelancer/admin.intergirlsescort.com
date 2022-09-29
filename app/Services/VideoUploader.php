<?php

namespace App\Services;

use App\Contracts\VideoUploaderInterface;
use Illuminate\Support\Str;
use Symfony\Component\HttpFoundation\File\File;

class VideoUploader implements VideoUploaderInterface
{
    public function upload($video, $folder, $prefix = ''): File
    {
        $fileName = $this->__getFileName($video, $prefix);
        return $video->move($this->_getSaveFolder($folder), $fileName);
    }

    protected function __getFullPathToVideo($video, $folder, $prefix)
    {
        return "{$this->_getSaveFolder($folder)}/{$this->__getFileName($video, $prefix)}";
    }

    protected function __getFileName($video, $prefix = '')
    {
        return "{$prefix}_{$this->_getOriginalName($video)}.{$video->getClientOriginalExtension()}";
    }

    private function _getSaveFolder($folder)
    {
        return config('video.dir.'. $folder) ?: config('video.dir.default');
    }

    private function _getOriginalName($video)
    {
        return Str::slug(pathinfo($video->getClientOriginalName(), PATHINFO_FILENAME));
    }

}
