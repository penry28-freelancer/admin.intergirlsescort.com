<?php

namespace App\Models;

use Carbon\Carbon;
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

    protected $appends = [
        'is_verified',
        'has_review',
        'is_new',
        'is_vip',
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

    public function clubHours()
    {
        return $this->hasMany(ClubHour::class);
    }

    public function accountable()
    {
        return $this->morphOne(Account::class, 'accountable');
    }

    public function escortsWithAccount()
    {
        return $this->hasMany(Escort::class)->with(['accountable']);
    }

    public function reviews()
    {
        return $this->hasMany(ClubReview::class);
    }

    public function avatar()
    {
        return $this->hasOneThrough(Image::class, Account::class, 'id', 'imageable_id')
            ->select('path');
    }

    // Getters
    public function getIsVerifiedAttribute()
    {
        return optional($this->accountable)->verified();
    }

    public function getHasReviewAttribute()
    {
        return optional($this->reviews)->count() > 0;
    }

    public function getIsNewAttribute()
    {
        $startOfNewComerDate = Carbon::now()->subDays(config('constants.limit_new_comer_day'));
        $escortCreatedDate = Carbon::parse($this->created_at);
        return  $escortCreatedDate->greaterThan($startOfNewComerDate);
    }

    public function getIsVipAttribute()
    {
        return optional(optional($this->accountable)->transactions)->count() > 0;
    }
}
