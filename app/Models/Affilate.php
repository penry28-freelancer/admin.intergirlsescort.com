<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Affilate extends Model
{
    use HasFactory;

    /**
     * The database table used this model
     */
    protected $table = 'affilates';

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'name',
        'tax_id',
        'website',
        'full_name',
        'address',
        'zip_code',
        'city',
        'country',
        'phone',
        'mail',
        'password',
        'is_verify',
    ];
}
