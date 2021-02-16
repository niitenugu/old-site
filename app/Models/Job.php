<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Job extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'title', 'details', 'uid', 'slug', 'opening_start_date',
        'opening_end_date', 'is_live',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'opening_start_date' => 'datetime',
        'opening_end_date' => 'datetime',
        'is_live' => 'boolean',
    ];

    // Mutators
    public function setIsLiveAttribute($value)
    {
        $this->attributes['is_live'] = boolval($value);
    }

    public function setSlugAttribute($value)
    {
    	$this->attributes['slug'] = str_slug($value) . '-' . time();
    }

    //Accessors
    public function getStatusAttribute()
    {
        return ($this->is_live) ? 'Visible' : 'Not Visible';
    }

    public function getOpeningStartsAttribute()
    {
    	return is_null($this->opening_start_date)
    			? null
    			: $this->opening_start_date->format('d M, Y');
    }

    public function getOpeningEndsAttribute()
    {
    	return is_null($this->opening_end_date)
    			? null
    			: $this->opening_end_date->format('d M, Y');
    }

}
