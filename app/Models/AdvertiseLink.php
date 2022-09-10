<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AdvertiseLink extends Model
{
    use HasFactory;

    /**
     * The database table used this model
     */
    protected $table = 'advertise_links';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'url',
        'advertise_id',
    ];
}
