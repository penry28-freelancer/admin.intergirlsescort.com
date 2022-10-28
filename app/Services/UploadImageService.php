<?php

namespace App\Services;

use Illuminate\Http\UploadedFile;
use Illuminate\Support\Str;

class UploadImageService extends UploadFileService
{
    public function upload(UploadedFile $file, $type)
    {
        $filename = $this->_makeUniqueFileName($file);

        return $this->put($file, $filename, 'images', $type);
    }

    private function _makeUniqueFileName(UploadedFile $file): string
    {
        return Str::slug($file->getClientOriginalName()) . "_" . Str::random(5) . "." . $file->getClientOriginalExtension();
    }
}
