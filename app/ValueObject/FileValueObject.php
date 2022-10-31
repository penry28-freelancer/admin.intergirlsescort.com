<?php

namespace App\ValueObject;

use App\Contracts\ValueObjectContract;

class FileValueObject implements ValueObjectContract
{
    public $name;
    public $path;
    public $type;
    public $ext;
    public $mime;
    public $size;
    public $disk;
    public $thumb;
    public $duration;

    public function __construct($name, $path, $type, $extension, $mime, $size, $disk, $thumbnail = null, $duration = null)
    {
        $this->name = $name;
        $this->path = $path;
        $this->type = $type;
        $this->ext = $extension;
        $this->mime = $mime;
        $this->size = $size;
        $this->disk = $disk;
        $this->thumb = $thumbnail;
        $this->duration = $duration;
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
            'disk'          => $this->disk,
            'thumb'         => $this->thumb,
            'duration'      => $this->duration,
        ];
    }
}
