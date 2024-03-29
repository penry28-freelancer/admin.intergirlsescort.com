<?php

namespace App\Models;

use App\Traits\EscortAddProperty;
use App\Traits\HasFilter;
use App\Traits\Imageable;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Escort extends BaseModel
{
    use HasFactory;
    use Imageable;
    use HasFilter;
    use EscortAddProperty;

    /**
     * The database table used this model
     */
    protected $table = 'escorts';

    protected $fillable = [
        'agency_id',
        'club_id',
        'belong_escort_id',
        'country_id',
        'city_id',
        'account_id',
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
        'dick_size',
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

    protected $appends = [
        'is_independent',
        'is_verified',
        'is_new',
        'is_pornstar',
        'is_vip',
        'has_video',
        'has_review',
    ];

    public function country()
    {
        return $this->belongsTo(Country::class);
    }

    public function city()
    {
        return $this->belongsTo(City::class);
    }
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
            ->withPivot(['name', 'order', 'from', 'to', 'day_id', 'escort_id', 'all_day']);
    }

    public function agency()
    {
        return $this->belongsTo(Agency::class);
    }

    public function accountable()
    {
        return $this->morphOne(Account::class, 'accountable');
    }

    public function account()
    {
        return $this->belongsTo(Account::class);
    }

    public function avatar()
    {
        return $this->hasOneThrough(Image::class, Account::class, 'id', 'imageable_id')
            ->select('path');
    }

    public function languages()
    {
        return $this->belongsToMany(Language::class, 'escort_language', 'escort_id', 'language_id');
    }

    public function blockCountries()
    {
        return $this->belongsToMany(Country::class, 'geo_country', 'escort_id', 'country_id');
    }

    public function images()
    {
        return $this->morphMany(Image::class, 'imageable');
    }

    public function banner()
    {
        return $this->morphOne(Image::class, 'imageable')->where('type', 'banner');
    }

    public function videoInfo()
    {
        return $this->hasOne(Video::class);
    }

    public function video()
    {
        return $this->hasOne(Video::class);
    }

    public function reviews()
    {
        return $this->hasMany(EscortReview::class);
    }

    public function hasReview()
    {
        return optional($this->reviews)->count() > 0;
    }

    public function belongEscort()
    {
        return $this->belongsTo(Escort::class, 'belong_escort_id');
    }

    public function escort()
    {
        return $this->hasOne(Escort::class, 'belong_escort_id');
    }

    public function transactions()
    {
        return $this->hasManyThrough(Transaction::class, Account::class,  'id', 'account_id', 'id');
    }

    public function tours()
    {
        return $this->hasMany(Tour::class)->with(['country', 'city']);
    }

    public function verified()
    {
        return optional($this->accountable)->verified();
    }

    public function isNewComer()
    {
        $startOfNewComerDate = Carbon::now()->subDays(config('constants.limit_new_comer_day'));
        $escortCreatedDate = Carbon::parse($this->created_at);
        return  $escortCreatedDate->greaterThan($startOfNewComerDate);
    }

    public function hasVideo()
    {
        return optional($this->videoInfo())->count();
    }

    public function isPornstar()
    {
        return $this->pornstar == config('constants.pornstar.yes');
    }

    public function isIndependent()
    {
        return $this->agency_id == null;
    }

    public function hasDouOfGirl()
    {
        return optional($this->belongEscort())->count() > 0 && $this->sex == config('constants.sex.label.5');
    }

    public function hasCouple()
    {
        return optional($this->belongEscort())->count() > 0 && $this->sex == config('constants.sex.label.4');
    }
}
