<?php

namespace App\Services;

use App\Contracts\UploadFileContract;
use App\ValueObject\FileValueObject;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

class UploadFileService implements UploadFileContract
{
    public  $file;
    public $disk;
    public $filename;
    public $type;
    public $path;
    public $thumb;
    public $duration;


    public function put(UploadedFile $file, $filename, $destination, $type = null, $disk = 'public')
    {
        $destination = rtrim($destination);
        $filename    = ltrim($filename, '/');

        $this->path = Storage::disk($disk)->putFileAs($destination, $file, $filename);
        $this->file     = $file;
        $this->disk     = $disk;
        $this->filename = $filename;
        $this->type     = $type;

        return $this->getResource();
    }

    public function getResource(): FileValueObject
    {
        return new FileValueObject(
            $this->filename,
            $this->path,
            $this->type,
            $this->file->getClientOriginalExtension(),
            $this->file->getSize(),
            $this->file->getClientMimeType(),
            $this->disk,
            $this->thumb,
            $this->duration
        );
    }
}
