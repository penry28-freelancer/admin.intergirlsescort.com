<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AccountMember extends Model
{
    use HasFactory;

    /**
     * The database table used this model
     */
    protected $table = 'account_members';

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
        'is_vetified',
        'email_verified_at',
    ];
}
