<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AgencyReview extends Model
{
    use HasFactory;

    /**
     * The database table used this model
     */
    protected $table = 'escort_reviews';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'nickname',
        'agency_id',
        'rating',
        'comment',
    ];
}
