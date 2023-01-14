<?php

namespace App\Services;

use App\Contracts\UploadFileContract;
use App\ValueObject\FileValueObject;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class UploadFileService implements UploadFileContract
{
    private $_file;
    private $_disk;
    private $_filename;
    private $_type;
    private $_path;

    public function put(UploadedFile $file, $destination, $filename = null, $type = null, $disk = 'public'): FileValueObject
    {
        $destination = rtrim($destination);
        $filename    = $filename ?? $this->__makeUniqueFileName($file);

        $this->__beforeUpload($file);
        $this->_path = Storage::disk($disk)->putFileAs($destination, $file, $filename);
        $this->_file     = $file;
        $this->_disk     = $disk;
        $this->_filename = $filename;
        $this->_type     = $type;
        $this->__afterUpload($file, $this->_path);

        return $this->getResource();
    }

    protected function __makeUniqueFileName(UploadedFile $file): string
    {
        return Str::slug($file->getClientOriginalName()) . "_" . Str::random(5) . "." . $file->getClientOriginalExtension();
    }

    public function getResource(): FileValueObject
    {
        return new FileValueObject(
            $this->_filename,
            $this->_path,
            $this->_type,
            $this->getFileExtension(),
            $this->getFileMimeType(),
            $this->getFileSize(),
            $this->_disk
        );
    }

    /**
     * @return mixed
     */
    public function getFile()
    {
        return $this->_file;
    }

    /**
     * @param mixed $file
     */
    public function setFile($file): void
    {
        $this->_file = $file;
    }

    /**
     * @return mixed
     */
    public function getDisk()
    {
        return $this->_disk;
    }

    /**
     * @param mixed $disk
     */
    public function setDisk($disk): void
    {
        $this->_disk = $disk;
    }

    /**
     * @return mixed
     */
    public function getFilename()
    {
        return $this->_filename;
    }

    /**
     * @param mixed $filename
     */
    public function setFilename($filename): void
    {
        $this->_filename = $filename;
    }

    /**
     * @return mixed
     */
    public function getType()
    {
        return $this->_type;
    }

    /**
     * @param mixed $type
     */
    public function setType($type): void
    {
        $this->_type = $type;
    }

    /**
     * @return mixed
     */
    public function getPath()
    {
        return $this->_path;
    }

    /**
     * @param mixed $path
     */
    public function setPath($path): void
    {
        $this->_path = $path;
    }

    /**
     * @return mixed
     */
    public function getFileExtension()
    {
        return $this->_file->getClientOriginalExtension();
    }

    /**
     * @return mixed
     */
    public function getFileMimeType()
    {
        return $this->_file->getMimeType();
    }

    /**
     * @return mixed
     */
    public function getFileSize()
    {
        return $this->_file->getSize();
    }

    protected function __beforeUpload($file)
    {
        // handle before upload
    }

    protected function __afterUpload($file, $path)
    {
        // handle after upload
    }

    public function upload($file, $folder, $type = null): FileValueObject
    {
        // TODO: Implement upload() method.
    }
}
