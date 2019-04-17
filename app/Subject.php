<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Subject extends Model
{
    protected $fillable = [
        'name', 'ec_value', 'course_id'
    ];

    public function course() {
        return $this->belongsTo(Course::class);
    }

    public function grades() {
        return $this->hasMany(Grade::class);
    }
}
