<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Agency extends Model
{
    use HasFactory;

    /**
     * The database table used this model
     */
    protected $table = 'agencies';

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'name',
        'location',
        'bio',
        'phone',
        'email',
        'last_seen_online_at',
        'country_id',
        'city_id',
    ];
}
