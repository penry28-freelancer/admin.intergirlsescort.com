<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Token extends Model
{
    use HasFactory;

    protected $table = 'tokens';

    protected $fillable = [
        'tokenable_id',
        'tokenable_type',
        'token',
        'is_verified',
        'email_verified_at',
    ];

    public function tokenable()
    {
        return $this->morphTo();
    }
}

