<?php

namespace App\ValueObject;


final class FileImageValueObject extends FileValueObject
{
    public function __construct($name, $path, $type, $extension, $mime, $size, $disk)
    {
        parent::__construct($name, $path, $type, $extension, $mime, $size, $disk);
    }
}
