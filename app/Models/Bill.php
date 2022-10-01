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
        'phone',
        'address',
        'zip_code',
        'city_id',
        'country_id',
        'company_name',
        'identity_number',
        'vat_id',
        'billable_id',
        'billable_type',
    ];

    public function country()
    {
        return $this->hasOne(Country::class);
    }

    public function city()
    {
        return $this->hasOne(Country::class);
    }

    public function billable()
    {
        return $this->morphTo();
    }
}
