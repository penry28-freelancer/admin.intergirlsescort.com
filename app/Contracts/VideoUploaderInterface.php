<?php

namespace App\Contracts;

use Illuminate\Http\UploadedFile;

interface VideoUploaderInterface
{
    public function upload(UploadedFile $video, $folder, $prefix);
}
