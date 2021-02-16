<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ScholarshipAttendee extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'first_name', 'last_name', 'uid', 'email', 'phone', 'scholarship_id', 
        'city', 'invitation_code', 'gender', 'checked_in_at', 
        'preferred_exam_time', 'school_level',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'checked_in_at' => 'datetime',
        'preferred_exam_time' => 'time',
    ];

    // Mutators
    public function setFirstNameAttribute($value)
    {
        $this->attributes['first_name'] = ucfirst($value);
    }

    public function setLastNameAttribute($value)
    {
        $this->attributes['last_name'] = ucfirst($value);
    }

    public function setEmailAttribute($value)
    {
        $this->attributes['email'] = strtolower($value);
    }

    //Accessors
    public function getFullnameAttribute()
    {
        return $this->last_name . ', ' . $this->first_name;
    }

    // Relationships
    public function scholarship()
    {
        return $this->belongsTo(Scholarship::class, 'scholarship_id', 'uid')->withDefault();
    }
}
