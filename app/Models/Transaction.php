<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
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
}
