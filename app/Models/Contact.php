<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    use HasFactory;

    /**
    * The database table used this model
    */
    protected $table = 'contacts';

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'name',
        'email',
        'receive_id',
        'message',
        'read_at',
    ];

    public function account()
    {
        return $this->belongsTo(Account::class, 'receive_id');
    }
}
