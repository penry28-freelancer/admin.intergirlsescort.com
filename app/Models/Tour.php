<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Tour extends BaseModel
{
    use HasFactory;

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

    public function setStartDateAttribute($value)
    {
        $this->attributes['start_date'] =  Carbon::parse($value);
    }

        public function setEndDateAttribute($value)
    {
        $this->attributes['end_date'] =  Carbon::parse($value);
    }
}
