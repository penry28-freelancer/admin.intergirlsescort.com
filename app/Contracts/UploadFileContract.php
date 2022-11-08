<?php

namespace App\Contracts;

use App\ValueObject\FileValueObject;
use Illuminate\Http\UploadedFile;

interface UploadFileContract
{
    public function put(UploadedFile $file, $destination, $filename = null, $type = null, $disk = 'public');

    public function upload($file, $folder, $type = null): FileValueObject;
}
