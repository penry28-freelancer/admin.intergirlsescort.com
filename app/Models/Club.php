<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Club extends Model
{
    use HasFactory;

    /**
    * The database table used this model
    */
    protected $table = 'clubs';

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'name',
        'hours_text',
        'website_url',
        'phone',
        'country_id',
        'city_id',
        'address',
    ];
}
