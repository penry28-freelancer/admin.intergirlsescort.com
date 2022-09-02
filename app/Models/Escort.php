<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;

class Escort extends BaseModel
{
    use HasFactory;

    /**
     * The database table used this model
     */
    protected $table = 'escorts';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'nickname',
        'organization',
        'last_seen_online_at',
        'bio',
        'gender',
        'birthday',
        'location',
        'eyes_id',
        'hair_color_id',
        'hair_length_id',
        'public_hair_id',
        'bust_size_id',
        'bust_type_id',
        'travel_id',
        'height_id',
        'ethnicity_id',
        'orientation_id',
        'smoker_id',
        'nationality_id',
        'service_content',
        'available_for',
        'meeting_with',
        'phone',
        'country_id',
        'city_id',
        'is_verified',
        'is_top',
        'is_vip',
        'video_id',
    ];
}
