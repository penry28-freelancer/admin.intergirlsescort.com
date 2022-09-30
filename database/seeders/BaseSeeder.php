<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class BaseSeeder extends Seeder
{
    protected $__disk;
    protected $__dir;
    protected $__demo_dir;

    public function __construct()
    {
        $dir  = image_storage_dir();

        if(! \Storage::exists($dir)) {
            \Storage::makeDirectory($dir, 0755, true, true);
        }

        $this->__dir = image_storage_dir();
        $this->__demo_dir = public_path('images/demo');
        $this->__disk = \Storage::disk(config('filesystems.default'));
    }
}
