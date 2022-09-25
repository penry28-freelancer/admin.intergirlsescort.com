<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;

class EscortReview extends BaseModel
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
        'country_id',
        'city_id',
        'escort_id',
        'meeting_date',
        'meeting_length',
        'price',
        'currency_id',
        'rating',
        'comment',
        'is_verified',
    ];

    public function escort()
    {
        return $this->belongsTo(Escort::class);
    }

    public function country()
    {
        return $this->belongsTo(Country::class);
    }

    public function city()
    {
        return $this->belongsTo(City::class);
    }

    public function currency()
    {
        return $this->belongsTo(Currency::class);
    }
}
