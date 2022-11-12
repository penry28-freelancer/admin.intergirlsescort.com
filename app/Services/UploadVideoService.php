<?php

namespace App\Services;

use App\Exceptions\VideoTooShortException;
use App\Jobs\CreateImageThumbnail;
use App\ValueObject\FileValueObject;
use App\ValueObject\FileVideoValueObject;
use FFMpeg\FFProbe;
use Illuminate\Http\UploadedFile;

class UploadVideoService extends UploadFileService
{
    private $_thumb;
    private $_duration;

    public function upload($file, $folder, $type = null): FileValueObject
    {
        return $this->put($file, $folder, $type);
    }

    /**
     * @throws VideoTooShortException
     */
    protected function __beforeUpload($file)
    {
        if(($duration = $this->getVideoDuration($file)) < 1) {
            throw new VideoTooShortException('Video too short');
        }

        $this->setDuration($duration);
        $this->setFilename($this->__makeUniqueFileName($file));
    }

    protected function __afterUpload($file, $path)
    {
        // get video thumbnail
        $thumb = $this->createVideoThumbnail();
        $this->setThumb($thumb);
    }

    public function createVideoThumbnail()
    {
        $videoDuration      = $this->getDuration();
        $configDuration     = config('video.thumbnail.at_duration');
        $configThumbPath    = config('video.thumbnail.folder.default');
        $configThumbExt     = config('video.thumbnail.extension');
        $filePath           = null;

        if($videoDuration > $configDuration && $videoDuration > 1) {
            $filePath = rtrim($configThumbPath, '/') . '/' . $this->getFileName() . ".$configThumbExt";
            $fileName = public_path('/storage/' . $filePath);
            $video = public_path('/storage/' . $this->getPath());

            // Will push it into queue
            CreateImageThumbnail::dispatch($video, $configDuration, $fileName);
        }

        return $filePath;
    }

    public function getVideoDuration(UploadedFile $file)
    {
        $ffmpeg = FFProbe::create([
            'ffmpeg.binaries'  => '/usr/bin/ffmpeg',
            'ffprobe.binaries' => '/usr/bin/ffprobe'
        ]);

        return ceil($ffmpeg->format($file->getPathname())->get('duration'));
    }

    public function getResource(): FileValueObject
    {
        $parent = parent::getResource();
        // $name, $path, $type, $extension, $mime, $size, $disk, $thumb, $duration
        return new FileVideoValueObject(
            $parent->name,
            $parent->path,
            $parent->type,
            $parent->ext,
            $parent->mime,
            $parent->size,
            $parent->disk,
            $this->getThumb(),
            $this->getDuration()
        );
    }

    /**
     * @return mixed
     */
    public function getThumb()
    {
        return $this->_thumb;
    }

    /**
     * @param mixed $thumb
     */
    public function setThumb($thumb): void
    {
        $this->_thumb = $thumb;
    }

    /**
     * @return mixed
     */
    public function getDuration()
    {
        return $this->_duration;
    }

    /**
     * @param mixed $duration
     */
    public function setDuration($duration): void
    {
        $this->_duration = $duration;
    }

}
