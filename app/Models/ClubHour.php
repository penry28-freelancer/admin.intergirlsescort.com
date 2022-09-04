<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ClubHour extends Model
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

    public function club()
    {
        return $this->belongsTo(Club::class);
    }
}
