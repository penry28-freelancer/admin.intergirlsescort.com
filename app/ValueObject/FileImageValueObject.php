<?php

namespace App\ValueObject;

use App\Contracts\ValueObjectContract;

final class FileImageValueObject implements ValueObjectContract
{
    private $_name;
    private $_path;
    private $_type;
    private $_originalName;
    private $_mime;
    private $_size;
    private $_disk;

    public function __construct($name, $path, $type, $originalName, $mime, $size, $disk)
    {
        $this->_name = $name;
        $this->_path = $path;
        $this->_type = $type;
        $this->_originalName = $originalName;
        $this->_mime = $mime;
        $this->_size = $size;
        $this->_disk = $disk;
    }

    public function toArray(): array
    {
        return [
            'name'          => $this->_name,
            'path'          => $this->_path,
            'type'          => $this->_type,
            'extension'     => $this->_originalName,
            'mime'          => $this->_mime,
            'size'          => $this->_size,
            'disk'          => $this->_disk,
        ];
    }
}
