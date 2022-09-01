<?php

namespace App\Models;

class CountryGroup extends BaseModel
{
    /**
     * The database table used this model
     */
    protected $table = 'country_groups';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
    ];

    public function countries()
    {
        return $this->hasMany(Country::class, 'group_id');
    }
}
