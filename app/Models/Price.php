<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;

class Price extends BaseModel
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

    public function currency()
    {
        return $this->hasOne(Currency::class);
    }
}
