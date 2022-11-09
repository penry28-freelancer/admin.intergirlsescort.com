<?php

namespace App\Models;

use App\Traits\HasFilter;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Video extends BaseModel
{
    use HasFactory;
    use HasFilter;

    /**
     * The database table used this model
     */
    protected $table = 'videos';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'escort_id',
        'account_id',
        'path',
        'views',
        'type',
        'duration',
        'thumbnail',
    ];

    public function escort()
    {
        return $this->belongsTo(Escort::class);
    }

    public function account()
    {
        return $this->belongsTo(Account::class);
    }

    public function transactions()
    {
        return $this->hasManyThrough(Transaction::class, Account::class, 'id');
    }

    public function getVideoUrlAttribute()
    {
        return get_storage_file_url($this->path);
    }
}
