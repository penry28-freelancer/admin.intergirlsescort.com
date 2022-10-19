<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;

class Image extends BaseModel
{
    use HasFactory;

    /**
     * The database table used by this model.
     * @var string
     */
    protected $table = 'images';

    /**
     * The attributes that are mass assignable
     * @var array
     */
    protected $fillable = [
        'name',
        'type',
        'path',
        'extension',
        'size',
        'order',
        'featured',
        'imageable_id',
        'imageable_type',
    ];

    protected $appends = [
        'image_path'
    ];

    /**
     * Get all of the owning imageable models.
     */
    public function imageable()
    {
        return $this->morphTo();
    }

    /**
     * Set the "featured" attribute
     */
    public function setFeatureAttribute($value)
    {
        $this->attributes['featured'] = (bool) $value ? $value : null;
    }

    public function getImagePathAttribute()
    {
        return url($this->path);
    }
}
