<?php

namespace App\ValueObject;


final class FileImageValueObject extends FileValueObject
{
    public function __construct($name, $path, $type, $extension, $mime, $size, $disk, $thumbnail, $duration)
    {
        parent::__construct($name, $path, $type, $extension, $mime, $size, $disk, $thumbnail, $duration);
    }

    public function toArray(): array
    {
        return [
            'name'          => $this->name,
            'path'          => $this->path,
            'type'          => $this->type,
            'extension'     => $this->ext,
            'mime'          => $this->mime,
            'size'          => $this->size,
            'disk'          => $this->disk
        ];
    }
}
