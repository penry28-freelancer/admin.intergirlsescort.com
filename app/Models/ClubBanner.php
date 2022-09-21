<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ClubBanner extends Model
{
    use HasFactory;

    /**
    * The database table used this model
    */
    protected $table = 'club_banners';

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'banner_image',
        'website_url',
        'club_id',
    ];
}
