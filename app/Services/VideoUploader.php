<?php

namespace App\Services;

use App\Contracts\VideoUploaderInterface;
use Illuminate\Support\Str;

class VideoUploader implements VideoUploaderInterface
{
    private $_publicPath = 'public';

    protected $__video;
    protected $__folder;
    protected $__prefix;

    public function upload($video, $folder = 'default', $prefix = '')
    {
        $this->_initParam($video, $folder, $prefix);

        $path =  $video->storeAs($this->_getSaveFolder(), $this->getFileName());

        return $this->_videoInfo($path, $this->__video, $this->__folder, $this->__prefix);
    }

    protected function _initParam($video, $folder, $prefix)
    {
        $this->__video = $video;
        $this->__folder = $folder;
        $this->__prefix = $prefix;
    }

    protected function __getFullPathToVideo($video, $folder, $prefix)
    {
        return "{$this->_getSaveFolder()}/{$this->getFileName()}";
    }

    public function getFileName()
    {
        return "{$this->__prefix}_{$this->_getOriginalName()}.{$this->getExtension()}";
    }

    private function _getSaveFolder()
    {
        return $this->_publicPath . '/' . config('video.dir.'. $this->__folder) ?: config('video.dir.default');
    }

    private function _getOriginalName()
    {
        return Str::slug(pathinfo($this->__video->getClientOriginalName(), PATHINFO_FILENAME));
    }

    public function getExtension()
    {
        return $this->__video->getClientOriginalExtension();
    }

    private function _videoInfo($path, $video, $folder, $prefix)
    {
        return new class ($path, $video, $folder, $prefix) extends VideoUploader {

            private $_path;
            private $_getID3;

            public function __construct($path, $video, $folder, $prefix)
            {
                $this->_path = $path;
                $this->_getID3 = new \getID3();
                $this->_initParam($video, $folder, $prefix);
            }
            public function getPathname()
            {
                return $this->_path;
            }

            public function getDuration()
            {
                return $this->getVideoInfo()['playtime_string'] ?? 0;
            }

            public function getVideoInfo()
            {
                return $this->_getID3->analyze($this->_path);
            }
        };
    }
}
