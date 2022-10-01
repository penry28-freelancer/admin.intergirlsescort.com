<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bill extends Model
{
    use HasFactory;

    protected $table = 'bills';

    protected $fillable = [
        'first_name',
        'last_name',
        'account_id',
        'phone',
        'address',
        'zip_code',
        'city_id',
        'country_id',
        'company_name',
        'identity_number',
        'vat_id',
    ];

    public function country()
    {
        return $this->hasOne(Country::class);
    }

    public function city()
    {
        return $this->hasOne(Country::class);
    }

    public function account()
    {
        return $this->belongsTo(Account::class);
    }
}
