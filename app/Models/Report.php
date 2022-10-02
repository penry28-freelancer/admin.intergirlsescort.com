<?php

namespace App\Models;

use App\Traits\Imageable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Report extends Model
{
    use HasFactory, Imageable;

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
        'nick',
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
