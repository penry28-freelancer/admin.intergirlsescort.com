<?php

namespace App\Models;

use App\Traits\Imageable;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ClubBanner extends BaseModel
{
    use HasFactory, Imageable;

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

    public function club()
    {
        return $this->belongsTo(Club::class);
    }
}
