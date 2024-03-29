<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;

class AgencyReview extends BaseModel
{
    use HasFactory;

    /**
     * The database table used this model
     */
    protected $table = 'agency_reviews';

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
        'is_verified',
    ];

    public function agency()
    {
        return $this->belongsTo(Agency::class);
    }
}
