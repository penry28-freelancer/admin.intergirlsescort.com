<?php

namespace App\Models;

use App\Traits\Imageable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use \Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Passport\HasApiTokens;

class Account extends Authenticatable
{
    use HasFactory, Notifiable, HasApiTokens, Imageable;

    protected $table = 'accounts';

    protected $guarded = 'client';

    protected $fillable = [
        'name',
        'email',
        'password',
        'gold',
        'token',
        'accountable_id',
        'accountable_type',
        'is_verified',
        'email_verified_at',
    ];

    protected $hidden = [
        'password', 'token'
    ];

    public function accountable()
    {
        return $this->morphTo();
    }

    public function profile()
    {
        $model = $this->accountable_type;
        $id = $this->accountable_id;
        return app()->make($model)->find($id);
    }

    public function bill()
    {
        return $this->hasOne(Bill::class);
    }

    public function transactions()
    {
        return $this->hasMany(Transaction::class);
    }

    public function verified()
    {
        return $this->is_verified == 1;
    }

    public function isEscort()
    {
        return $this->accountable_type == Escort::class;
    }

    public function isAgency()
    {
        return $this->accountable_type == Agency::class;
    }

    public function isClub()
    {
        return $this->accountable_type == Club::class;
    }

    public function isMember()
    {
        return $this->accountable_type == Member::class;
    }

    public function getTypeAttribute()
    {
        if ($this->accountable_type === Escort::class) return config('constants.account_type.key.escort');
        if ($this->accountable_type === Agency::class) return config('constants.account_type.key.agency');
        if ($this->accountable_type === Club::class) return config('constants.account_type.key.club');
        if ($this->accountable_type === Member::class) return config('constants.account_type.key.member');
    }

    public function favorites()
    {
        return $this->belongsToMany(Account::class, 'account_favorites', 'sender_id', 'receiver_id')
            // ->select(['accountable_type'])
            ->withCount('transactions')
            ->orderBy('transactions_count', 'desc');
    }
}
