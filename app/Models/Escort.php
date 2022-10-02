<?php

namespace App\Models;

use App\Traits\Imageable;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Escort extends BaseModel
{
    use HasFactory, Imageable;

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
        'agency_id',
        'country_id',
        'city_id',
        'perex',
        'sex',
        'birt_year',
        'height',
        'weight',
        'ethnicity',
        'hair_color',
        'hair_lenght',
        'bust_size',
        'bust_type',
        'provides1',
        'nationality_counter_id',
        'travel',
        'tattoo',
        'piercing',
        'smoker',
        'eye',
        'orientation',
        'hair_pubic',
        'pornstar',
        'verify_text',
        'provides',
        'meeting_with',
        'website',
        'phone1_code',
        'phone1',
        'phone1_viber',
        'phone1_whatsapp',
        'phone1_wechat',
        'phone1_telegram',
        'phone1_lineapp',
        'phone1_signal',
        'phone1_wechatid',
        'phone1_lineappid',
        'phone1_telegramid',
        'phone2_code',
        'phone2',
        'phone2_viber',
        'phone2_whatsapp',
        'phone2_wechat',
        'phone2_telegram',
        'phone2_lineapp',
        'phone2_signal',
        'phone2_wechatid',
        'phone2_lineappid',
        'phone2_telegramid',
        'video',
        'counter_currency_id',
        'rate_incall_30',
        'rate_outvall_30',
        'rate_incall_1',
        'rate_outvall_1',
        'rate_incall_2',
        'rate_outvall_2',
        'rate_incall_3',
        'rate_outvall_3',
        'rate_incall_6',
        'rate_outvall_6',
        'rate_incall_12',
        'rate_outvall_12',
        'rate_incall_24',
        'rate_outvall_24',
        'rate_incall_48',
        'rate_outvall_48',
        'rate_incall_24_second',
        'rate_outvall_24_second',
        'timezone',
        'available_for'
    ];

    //Relationship
    public function escort_day()
    {
        return $this->hasMany(EscortDay::class);
    }

    public function escort_language()
    {
        return $this->hasMany(EscortLanguage::class);
    }

    public function escort_service()
    {
        return $this->hasMany(EscortService::class);
    }

    public function services()
    {
        return $this->belongsToMany(Service::class)
            ->withPivot(['is_included', 'extra_price']);
    }

    public function works()
    {
        return $this->belongsToMany(Day::class, 'escort_day')
            ->withPivot(['name', 'order', 'from', 'to']);
    }

    public function agency()
    {
        return $this->belongsTo(Agency::class);
    }

    public function accountable()
    {
        return $this->morphOne(Account::class, 'accountable');
    }

    public function languages()
    {
        return $this->belongsToMany(Language::class);
    }

    public function blockCountries()
    {
        return $this->belongsToMany(Country::class, 'geo_country', 'escort_id', 'country_id');
    }

    public function images()
    {
        return $this->morphMany(Image::class, 'imageable');
    }

    public function videoInfo()
    {
        return $this->hasOne(Video::class);
    }

    public function belongEscort()
    {
        return $this->hasOne(Escort::class, 'belong_escort_id');
    }
}
