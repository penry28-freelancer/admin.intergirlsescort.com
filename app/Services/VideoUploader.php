<?php

namespace App\Services;

use App\Contracts\VideoUploaderInterface;
use FFMpeg\FFProbe;
use Illuminate\Support\Str;

class VideoUploader implements VideoUploaderInterface
{
    private $_publicPath = '';
    private $_storagePath = 'app/public';

    protected $__video;
    protected $__folder;
    protected $__prefix;

    public function upload($video, $folder = 'default', $prefix = '')
    {
        $this->_initParam($video, $folder, $prefix);

        $path = $video->storeAs($this->_getSaveFolder(), $this->getFileName(), 'public');
//        Storage::disk()->put($this->__getFullPathToVideo(), file_get_contents($video));
//        $path = $this->_publicPath . '/' . $path;
        return $this->_videoInfo($path, $this->__video, $this->__folder, $this->getFileName(), $this->__prefix, $this->_storagePath);
    }

    protected function _initParam($video, $folder, $prefix)
    {
        $this->__video = $video;
        $this->__folder = $folder;
        $this->__prefix = $prefix;
    }

    protected function __getFullPathToVideo()
    {
        return "{$this->_getSaveFolder()}/{$this->getFileName()}";
    }

    public function getFileName()
    {
        $randString = Str::random(5);
        return "{$this->__prefix}_{$this->_getOriginalName()}_{$randString}.{$this->getExtension()}";
    }

    private function _getSaveFolder()
    {
        $publicPath = !empty($this->_publicPath) ? $this->_publicPath . '/' : $this->_publicPath;
        return $publicPath . config('video.dir.'. $this->__folder) ?: config('video.dir.default');
    }

    private function _getOriginalName()
    {
        return Str::slug(pathinfo($this->__video->getClientOriginalName(), PATHINFO_FILENAME));
    }

    public function getExtension()
    {
        return $this->__video->getClientOriginalExtension();
    }

    private function _videoInfo($path, $video, $folder, $fileName, $prefix, $storagePath)
    {
        return new class ($path, $video, $folder, $fileName, $prefix, $storagePath) extends VideoUploader {

            private $_path;
            private $_ffmpeg;
            private $_storagePath;
            private $_fileName;

            public function __construct($path, $video, $folder, $fileName, $prefix, $storagePath)
            {
                $this->_path = $path;
                $this->_storagePath = $storagePath;
                $this->_fileName = $fileName;
                $this->_ffmpeg = FFProbe::create([
                    'ffmpeg.binaries'  => '/usr/bin/ffmpeg',
                    'ffprobe.binaries' => '/usr/bin/ffprobe'
                ]);
                $this->_initParam($video, $folder, $prefix);
            }
            public function getPathname()
            {
                return $this->_path;
            }

            public function getStoragePath()
            {
                return $this->_storagePath;
            }

            public function getDuration()
            {
                return ceil($this->_ffmpeg->format($this->_getVideoPath())->get('duration'));
            }

            public function getThumbnail()
            {
                $videoDuration = $this->getDuration();
                $configDuration = config('video.thumbnail.at_duration');
                $configThumbPath =  config('video.thumbnail.folder.default');
                $configThumbExt =  config('video.thumbnail.extension');

                if($videoDuration > $configDuration) {
                    $getAtSecond = "00:00:" . str_pad($configDuration, 2, '0');
                    $filePath = "/$configThumbPath/" . $this->getFileName() . ".$configThumbExt";
                    $thumbnail = storage_path($this->_storagePath . $filePath);
                    $videoPath = $this->_getVideoPath();
                    // Will push it into queue
                    shell_exec("ffmpeg -i $videoPath -deinterlace -an -ss 1 -t $getAtSecond -r 1 -y -vcodec mjpeg -f mjpeg $thumbnail 2>&1");
                    return $filePath;
                } else {
                    return null;
                }
            }

            private function _getVideoPath()
            {
                return storage_path($this->_storagePath . '/' . $this->_path);
            }
        };
    }
}
