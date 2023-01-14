<?php

namespace App\Models;

use App\Traits\Imageable;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Advertise extends BaseModel
{
    use HasFactory, Imageable;

    /**
     * The database table used this model
     */
    protected $table = 'advertises';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'link1',
        'link2',
        'link3',
        'order',
    ];
}
