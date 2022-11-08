<?php

namespace App\Services;

use App\ValueObject\FileValueObject;

class UploadImageService extends UploadFileService
{
    public function upload($file, $folder, $type = null): FileValueObject
    {
        return $this->put($file, $folder, null, $type);
    }
}
