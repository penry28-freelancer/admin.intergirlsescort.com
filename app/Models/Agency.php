<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;

class Agency extends BaseModel
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
        'country_id',
        'city_id',
        'account_id',
        'description',
        'website',
        'calling_country_id_1',
        'phone_1',

        'phone1_viber' ,
        'phone1_whatsapp',
        'phone1_wechat',
        'phone1_telegram',
        'phone1_lineapp',
        'phone1_signal',
        'phone1_wechatid',
        'phone1_lineappid',
        'phone1_telegramid',

        'calling_country_id_2',
        'phone_2',

        'phone2_viber' ,
        'phone2_whatsapp',
        'phone2_wechat',
        'phone2_telegram',
        'phone2_lineapp',
        'phone2_signal',
        'phone2_wechatid',
        'phone2_lineappid',
        'phone2_telegramid',

        'banner_url',
    ];

    public function escorts()
    {
        return $this->hasMany(Escort::class);
    }

    public function country()
    {
        return $this->belongsTo(Country::class);
    }

    public function city()
    {
        return $this->belongsTo(City::class);
    }

    public function accountable()
    {
        return $this->morphOne(Account::class, 'accountable');
    }

    public function escortsWithAccount()
    {
        return $this->hasMany(Escort::class)->with(['accountable']);
    }

    public function tours()
    {
        return $this->hasMany(Tour::class);
    }

    public function reviews()
    {
        return $this->hasMany(AgencyReview::class);
    }

    public function avatar()
    {
        return $this->hasOneThrough(Image::class, Account::class, 'id', 'imageable_id')
            ->select('path');
    }
}
