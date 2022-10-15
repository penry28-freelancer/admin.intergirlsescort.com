<?php

namespace App\Models;

use App\Traits\HasFilter;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class AgencyReport extends BaseModel
{
    use HasFactory, HasFilter;

    /**
    * The database table used this model
    */
    protected $table = 'agency_reports';

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'nick_name',
        'name_of_agency',
        'country_id',
        'city_id',
        'website',
        'calling_country_id',
        'phone',
        'email',
        'description',
        'verified_at',
    ];
}
