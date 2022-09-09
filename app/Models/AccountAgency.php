<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AccountAgency extends Model
{

    /**
     * The database table used this model
     */
    protected $table = 'account_agencies';

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'country_id',
        'city_id',
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
        'is_vetified',
        'email_verified_at',
    ];
}
