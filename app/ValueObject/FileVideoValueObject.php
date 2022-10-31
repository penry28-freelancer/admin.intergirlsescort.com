<?php

namespace App\ValueObject;


final class FileVideoValueObject extends FileValueObject
{
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
