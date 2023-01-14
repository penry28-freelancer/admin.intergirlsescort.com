<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;

class PageContent extends BaseModel
{
    use HasFactory;

    /**
     * The database table used this model
     */
    protected $table = 'page_contents';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'title',
        'content',
    ];
}
