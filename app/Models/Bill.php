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
        'company_name null',
        'identity_number null',
        'vat_id null',
        'billable_id',
        'billable_type',
    ];
}
