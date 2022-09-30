<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Price extends Model
{
    use HasFactory;

    protected $table = 'prices';

    protected $fillable = [
        'currency_id',
        'price',
        'gold',
        'you_save',
        'is_popular',
        'is_best',
    ];
}
