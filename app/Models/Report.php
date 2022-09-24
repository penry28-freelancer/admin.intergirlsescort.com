<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Report extends Model
{
    use HasFactory;

    /**
    * The database table used this model
    */
    protected $table = 'reports';

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'nick_name',
        'name',
        'country_id',
        'city_id',
        'website',
        'calling_country_id',
        'phone',
        'email',
        'description',
        'type',
        'verified_at',
    ];
}
