<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;

class Transaction extends BaseModel
{
    use HasFactory;

    protected $table = 'transactions';

    const PENDING = 2;
    const DECLINE = 0;
    const SUCCESS = 1;

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

    public function isSuccess()
    {
        return $this->status === self::SUCCESS;
    }

    public function markSuccess()
    {
        $this->status = self::SUCCESS;
        $this->save();
    }

    public function markDeclined()
    {
        $this->status = self::DECLINE;
        $this->save();
    }
}
