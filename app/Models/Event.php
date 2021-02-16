<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'title', 'details', 'uid', 'slug', 'start_date', 'end_date', 'time', 
        'registration_start_date', 'registration_end_date', 'is_live', 
        'image_url', 'image_name', 'venue'
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'start_date' => 'datetime',
        'end_date' => 'datetime',
        'time' => 'time',
        'registration_start_date' => 'datetime',
        'registration_end_date' => 'datetime',
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

    public function getPhotoAttribute()
    {
        $placeholder = asset('assets/img/event_placeholder.svg');

        return ($this->image_url != '') ? $this->image_url : $placeholder;
    }

    public function getShortContentAttribute()
    {
        return str_limit($this->details, 215, ' ...');
    }

    public function getShorterContentAttribute()
    {
        return str_limit($this->details, 90, ' ...');
    }

    public function getEventStartsAttribute()
    {
    	return is_null($this->start_date) 
    			? null
    			: $this->start_date->format('d M, Y');
    }

    public function getEventEndsAttribute()
    {
    	return is_null($this->end_date) 
    			? null
    			: $this->end_date->format('d M, Y');
    }

    public function getEventDateAttribute()
    {
        $eventDate = null;

        if (! is_null($this->start_date)) {
        	$startDate = $this->getEventStartsAttribute();
        	$endDate = $this->getEventEndsAttribute();

        	$endDate = ! is_null($endDate) ? ' to ' . $endDate : '';

        	$eventDate = $startDate . $endDate;
        }

        return $eventDate;
    }

    public function getRegistrationStartsAttribute()
    {
    	return is_null($this->registration_start_date) 
    			? null
    			: $this->registration_start_date->format('d M, Y');
    }

    public function getRegistrationEndsAttribute()
    {
    	return is_null($this->registration_end_date) 
    			? null
    			: $this->registration_end_date->format('d M, Y');
    }

    public function getRegistrationDateAttribute()
    {
    	$registrationDate = null;

    	if (! is_null($this->registration_start_date)) {
    		$starts = $this->getRegistrationStartsAttribute();
    		$ends = $this->getRegistrationEndsAttribute();

    		$ends = ! is_null($ends) ? ' to ' . $ends : '';

    		$registrationDate = $starts . $ends;
    	}

    	return $registrationDate;
    }

    // Relationshps
    public function attendees()
    {
        return $this->hasMany(Attendee::class, 'event_id', 'uid');
    }
}
