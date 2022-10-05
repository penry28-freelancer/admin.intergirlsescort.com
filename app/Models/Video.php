<?php

namespace App\Models;

use App\Traits\HasFilter;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Video extends BaseModel
{
    use HasFactory, HasFilter;

    /**
     * The database table used this model
     */
    protected $table = 'videos';

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

    public function escort()
    {
        return $this->belongsTo(Escort::class);
    }

}
