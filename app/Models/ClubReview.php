<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ClubReview extends Model
{
    use HasFactory;

    /**
     * The database table used this model
     */
    protected $table = 'club_reviews';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'nickname',
        'club_id',
        'rating',
        'comment',
        'is_verified',
    ];

    public function club()
    {
        return $this->belongsTo(Club::class);
    }
}
