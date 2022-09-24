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
    
    public function upload($video, $folder = '', $prefix = '')
    {   
        $this->_initParam($video, $folder, $prefix); 
        
        $path =  $video->storeAs($this->_getSaveFolder($folder), $this->getFileName()); 
 
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
        return "{$this->_getSaveFolder($folder)}/{$this->getFileName($video, $prefix)}";
    }

    public function getFileName()
    {
        return "{$this->__prefix}_{$this->_getOriginalName($this->__video)}.{$this->getExtension($this->__video)}";
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

            public function __construct($path, $video, $folder, $prefix)
            {   
                $this->path = $path;
                $this->_initParam($video, $folder, $prefix); 
            }
            public function getPathname()
            {
                return $this->path;
            } 
        };
    }
}
