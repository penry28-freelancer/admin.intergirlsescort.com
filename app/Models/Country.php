<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;

class Country extends BaseModel
{
    use HasFactory;

    /**
     * The database table used this model
     */
    protected $table = 'countries';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'full_name',
        'calling_code',
        'flag_image',
        'group_id',
    ];

    public function group()
    {
        return $this->belongsTo(CountryGroup::class, 'group_id');
    }

    public function cities()
    {
        return $this->hasMany(City::class);
    }

    public function tours()
    {
        return $this->hasMany(Tour::class);
    }

    public function clubs()
    {
        return $this->hasMany(Club::class);
    }
}
