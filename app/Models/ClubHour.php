<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;

class ClubHour extends BaseModel
{
    use HasFactory;

    /**
    * The database table used this model
    */
    protected $table = 'club_hours';

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'title',
        'club_id',
    ];
}
