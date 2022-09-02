<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;

class Faq extends BaseModel
{
    use HasFactory;

    /**
     * The database table used this model
     */
    protected $table = 'faqs';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'question',
        'answer',
        'type',
    ];
}
