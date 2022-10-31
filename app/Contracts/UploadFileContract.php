<?php

namespace App\Contracts;

use Illuminate\Http\UploadedFile;

interface UploadFileContract
{
    public function put(UploadedFile $file, $filename, $destination, $type = null, $disk = 'public');
}
