<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'description', 'slug', 'uid', 'is_live',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
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

    public function getShortDescriptionAttribute()
    {
        return str_limit($this->description, 195, ' ');
    }

    // Relationshps
    public function courses()
    {
        return $this->hasMany(Course::class, 'category_id', 'uid');
    }
}
