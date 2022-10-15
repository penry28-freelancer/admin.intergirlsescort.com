<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;

class Transaction extends BaseModel
{
    use HasFactory;

    protected $table = 'transactions';

    protected $fillable = [
        'transaction_id',
        'account_id',
        'payment_type',
        'price_id',
        'price_num',
        'status',
    ];

    public function account()
    {
        return $this->belongsTo(Account::class);
    }

    public function price()
    {
        return $this->belongsTo(Price::class);
    }
}
