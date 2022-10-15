<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;

class Affilate extends BaseModel
{
    use HasFactory;

    /**
     * The database table used this model
     */
    protected $table = 'affilates';

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'website',
        'surname',
        'address',
        'zip',
        'city',
        'country',
        'phone',
        'is_verify',
    ];

    public function accountable()
    {
        return $this->morphOne(Account::class, 'accountable');
    }
}
