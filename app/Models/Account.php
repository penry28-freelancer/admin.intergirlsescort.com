<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use \Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Passport\HasApiTokens;

class Account extends Authenticatable
{
    use HasFactory, Notifiable, HasApiTokens;

    protected $table = 'accounts';

    protected $guarded = 'client';

    protected $fillable = [
        'name',
        'email',
        'password',
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
}
