<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EscostReport extends Model
{
    use HasFactory;


    /**
    * The database table used this model
    */
    protected $table = 'escost_reports';

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'nick_name',
        'name_of_escost',
        'country_id',
        'city_id',
        'calling_country_id',
        'phone',
        'email',
        'description',
        'verified_at',
    ];
}
