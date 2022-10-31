<?php

namespace App\Services;

use App\ValueObject\FileImageValueObject;
use App\ValueObject\FileValueObject;
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

    public function getResource(): FileValueObject
    {
        return new FileImageValueObject(
            $this->filename,
            $this->path,
            $this->type,
            $this->extension,
            $this->mime,
            $this->size,
            $this->disk
        );
    }
}
