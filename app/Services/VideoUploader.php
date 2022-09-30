<?php

namespace App\Services;

use App\Contracts\VideoUploaderInterface; 
use Illuminate\Support\Str; 

class VideoUploader implements VideoUploaderInterface
{  
    private $_publicPath = 'public';

    protected $_video;
    protected $_folder;
    protected $_prefix;
    
    public function upload($video, $folder = '', $prefix = '')
    {   
        $this->_initParam($video, $folder, $prefix); 
        
        $path =  $video->storeAs($this->_getSaveFolder($folder), $this->getFileName()); 
 
        return $this->_videoInfo($path, $this->_video, $this->_folder, $this->_prefix);
    }

    protected function _initParam($video, $folder, $prefix)
    {
        $this->_video = $video;
        $this->_folder = $folder;
        $this->_prefix = $prefix;
    }

    protected function __getFullPathToVideo($video, $folder, $prefix)
    {
        return "{$this->_getSaveFolder($folder)}/{$this->getFileName($video, $prefix)}";
    }

    public function getFileName()
    {
        return "{$this->_prefix}_{$this->_getOriginalName($this->_video)}.{$this->getExtension($this->_video)}";
    }

    private function _getSaveFolder()
    {
        return $this->_publicPath . '/' . config('video.dir.'. $this->_folder) ?: config('video.dir.default');
    }

    private function _getOriginalName()
    {
        return Str::slug(pathinfo($this->_video->getClientOriginalName(), PATHINFO_FILENAME));
    }

    public function getExtension()
    {
        return $this->_video->getClientOriginalExtension();
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
