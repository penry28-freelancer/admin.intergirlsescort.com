<?php

namespace App\Models;

use App\Traits\HasFilter;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ClientReport extends Model
{
    use HasFactory, HasFilter;

    /**
    * The database table used this model
    */
    protected $table = 'client_reports';

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'nick_name',
        'name_of_client',
        'country_id',
        'city_id',
        'date_added',
        'calling_country_id',
        'phone',
        'email',
        'description',
        'verified_at',
    ];
}
