<?php

namespace App\Contracts;

interface UploadFileContract
{
    public function put($file, $filename, $destination, $type = null, $disk = 'public');
}
