<?php

namespace App\Services;

use App\Contracts\VideoUploaderInterface;
use App\Jobs\CreateImageThumbnail;
use FFMpeg\FFProbe;
use Illuminate\Support\Str;

class VideoUploader implements VideoUploaderInterface
{
    private $_publicPath = '';
    private $_storagePath = 'app/public';

    protected $__video;
    protected $__folder;
    protected $__prefix;
    private $_path;

    public function upload($video, $folder = 'default', $prefix = '')
    {
        $this->_initParam($video, $folder, $prefix);

        $this->_path = $video->storeAs($this->_getSaveFolder(), $this->getFileName(), 'public');
//        Storage::disk()->put($this->__getFullPathToVideo(), file_get_contents($video));
//        $path = $this->_publicPath . '/' . $path;
        return $this->_videoInfo();
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

    private function _videoInfo()
    {
        return [
            'path' => $this->_path,
            'filename' => $this->getFileName(),
            'duration' => $this->getDuration(),
            'thumbnail' => $this->getThumbnail(),
            'extension' => $this->getExtension(),
        ];
    }

    public function getPathName()
    {
        return $this->_path;
    }

    private function _getVideoPath($path)
    {
        return storage_path($this->_storagePath . '/' . $path);
    }

    public function getThumbnail()
    {
        $videoDuration = $this->getDuration();
        $configDuration = config('video.thumbnail.at_duration');
        $configThumbPath =  config('video.thumbnail.folder.default');
        $configThumbExt =  config('video.thumbnail.extension');

        if($videoDuration > $configDuration && $videoDuration > 1) {
            $getAtSecond = "00:00:" . str_pad($configDuration, 2, '0');
            $filePath = "/$configThumbPath/" . $this->getFileName() . ".$configThumbExt";
            $fileName = storage_path($this->_storagePath . $filePath);
            // Will push it into queue
            dispatch(new CreateImageThumbnail($this->_path, $getAtSecond, $fileName));
            return $filePath;
        } else {
            return null;
        }
    }

    public function getDuration()
    {
        $ffmpeg = FFProbe::create([
            'ffmpeg.binaries'  => '/usr/bin/ffmpeg',
            'ffprobe.binaries' => '/usr/bin/ffprobe'
        ]);
        return ceil($ffmpeg->format($this->_getVideoPath($this->_path))->get('duration'));
    }
}
