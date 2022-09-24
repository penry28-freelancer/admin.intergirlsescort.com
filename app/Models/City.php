<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;

class City extends BaseModel
{
    use HasFactory;

    /**
     * The database table used this model
     */
    protected $table = 'cities';

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'name',
        'country_id',
    ];

    public function country()
    {
        return $this->belongsTo(Country::class);
    }

    public function tours()
    {
        return $this->hasMany(Tour::class);
    }

    public function clubs()
    {
        return $this->hasMany(Club::class);
    }

    public function escorts()
    {
        return $this->hasMany(Escort::class);
    }

    public function verified_escorts()
    {
        return $this->hasMany(Escort::class)->where('escorts.verify_text', '=', '1');
    }
}
