<?php

namespace App\Services;

use App\Contracts\UploadFileContract;
use App\ValueObject\FileImageValueObject;
use Illuminate\Support\Facades\Storage;

class UploadFileService implements UploadFileContract
{
    public function put($file, $filename, $destination, $type = null, $disk = 'public')
    {
        $destination = rtrim($destination);
        $filename    = ltrim($filename, '/');

        $path = Storage::disk($disk)->putFileAs($destination, $file, $filename);

        return new FileImageValueObject(
            $filename,
            $path,
            $type,
            $file->getClientOriginalName(),
            $file->getClientMimeType(),
            $file->getSize(),
            $disk
        );
    }
}
