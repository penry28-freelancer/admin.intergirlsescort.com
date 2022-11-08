<?php

namespace App\ValueObject;


final class FileVideoValueObject extends FileValueObject
{
    public $thumb;
    public $duration;

    public function __construct($name, $path, $type, $extension, $mime, $size, $disk, $thumb, $duration)
    {
        parent::__construct($name, $path, $type, $extension, $mime, $size, $disk);
        $this->thumb = $thumb;
        $this->duration = $duration;
    }

    public function toArray(): array
    {
        return [
            'name'          => $this->name,
            'path'          => $this->path,
            'type'          => $this->ext,
            'extension'     => $this->ext,
            'mime'          => $this->mime,
            'size'          => $this->size,
            'disk'          => $this->disk,
            'thumbnail'     => $this->thumb,
            'duration'      => $this->duration,
        ];
    }
}
