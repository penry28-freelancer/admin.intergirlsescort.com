<?php

namespace App\Models;

use Hash;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Laravel\Passport\HasApiTokens;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use HasApiTokens, Notifiable, HasFactory;

    /**
     * The database table used this model
     */
    protected $table = 'users';

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'active',
        'email_verified_at',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'active'            => 'boolean',
    ];

    /**
     * Set permissions guard to API by default
     * @var string
     */
    protected $guard_name = 'api';

    /**
     * Set password for the user.
     *
     * @return array
     */
    public function setPasswordAttribute($password)
    {
        $this->attributes['password'] = \Hash::needsRehash($password) ? \Hash::make($password) : $password;
    }

    /**
     * Routes notification for the mail channel.
     *
     * @return string
     */
    public function routeNotificationForMail()
    {
        return $this->email;
    }
}
