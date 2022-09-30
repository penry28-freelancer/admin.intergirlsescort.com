<?php

namespace App\Contracts;

interface VideoUploaderInterface
{
    public function upload($video, $folder, $prefix);
}
