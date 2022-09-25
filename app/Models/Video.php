<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;

class Video extends BaseModel
{
    use HasFactory;

    /**
     * The database table used this model
     */
    protected $table = 'countries';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'path',
        'views',
        'type',
    ];
}
