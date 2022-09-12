<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AccountClubHour extends Model
{
    use HasFactory;

    /**
    * The database table used this model
    */
    protected $table = 'account_club_hours';

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'title',
        'club_id',
    ];
}
