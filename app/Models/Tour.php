<?php

namespace App\Models;

use App\Traits\HasFilter;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Carbon\Carbon;

class Tour extends BaseModel
{
    use HasFactory, HasFilter;

    /**
     * The database table used this model
     */
    protected $table = 'tours';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'title',
        'agency_id',
        'escort_id',
        'start_date',
        'end_date',
        'country_id',
        'city_id',
    ];

    public function country()
    {
        return $this->belongsTo(Country::class);
    }

    public function city()
    {
        return $this->belongsTo(City::class);
    }

    public function escort()
    {
        return $this->belongsTo(Escort::class);
    }

    public function agency()
    {
        return $this->belongsTo(Agency::class);
    }

    public function setStartDateAttribute($value)
    {
        $this->attributes['start_date'] =  Carbon::parse($value);
    }

        public function setEndDateAttribute($value)
    {
        $this->attributes['end_date'] =  Carbon::parse($value);
    }
}
