<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;

class Day extends BaseModel
{
    use HasFactory;

    /**
     * The database table used this model
     */
    protected $table = 'days';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'order'
    ];
}
