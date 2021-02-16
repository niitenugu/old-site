<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'title', 'details', 'uid', 'slug', 'duration', 'cost', 'discount', 
        'is_live', 'image_url', 'image_name', 'category_id',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'cost' => 'float',
        'duration' => 'integer',
        'discount' => 'float',
        'is_live' => 'boolean',
    ];

    // Mutators
    public function setIsLiveAttribute($value)
    {
        $this->attributes['is_live'] = boolval($value);
    }

    public function setSlugAttribute($value)
    {
    	$this->attributes['slug'] = str_slug($value);
    }

    //Accessors
    public function getStatusAttribute()
    {
        return ($this->is_live) ? 'Visible' : 'Not Visible';
    }

    public function getPhotoAttribute()
    {
        $placeholder = asset('assets/img/placeholder.png');

        return ($this->image_url != '') ? $this->image_url : $placeholder;
    }

    public function getPeriodAttribute()
    {
        if ($this->duration > 12) {
            $years = intval($this->duration / 12);
            $months = $this->duration % 12;
            
            return $months == 0 
                    ? $years . str_plural(' year', $years)
                    : $years . str_plural(' year', $years) . ' ' . $months . str_plural(' month', $months);
        }

        return $this->duration . str_plural(' month', $this->duration);
    }

    public function getShortContentAttribute()
    {
        $stripWords = str_replace('Course Description', '', $this->details);
        return str_limit($stripWords, 215, ' ...');
    }

    // Relationships
    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id', 'uid')->withDefault();
    }
}
