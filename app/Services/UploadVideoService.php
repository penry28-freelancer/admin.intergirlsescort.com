<?php

namespace App\Services;

use App\ValueObject\FileValueObject;
use App\ValueObject\FileVideoValueObject;

class UploadVideoService extends UploadFileService
{
    public function upload($file, $folder)
    {

    }

    public function getResource(): FileValueObject
    {
        return new FileVideoValueObject(

        );
    }
}
