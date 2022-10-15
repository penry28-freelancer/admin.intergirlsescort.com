<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;

class Club extends BaseModel
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
        'address',
        'country_id',
        'city_id',
        'account_id',
        'description',
        'website',
        'calling_country_id_1',
        'phone_1',
        'is_viber_1',
        'is_whatsapp_1',
        'wechat_1',
        'telegram_1',
        'line_1',
        'is_signal_1',
        'calling_country_id_2',
        'phone_2',
        'is_viber_2',
        'is_whatsapp_2',
        'wechat_2',
        'telegram_2',
        'line_2',
        'is_signal_2',
        'banner_url',
    ];

    public function country()
    {
        return $this->belongsTo(Country::class);
    }

    public function city()
    {
        return $this->belongsTo(City::class);
    }

    public function clubHours()
    {
        return $this->hasMany(ClubHour::class);
    }

    public function accountable()
    {
        return $this->morphOne(Account::class, 'accountable');
    }

    public function reviews()
    {
        return $this->hasMany(ClubReview::class);
    }

}
