<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Grade extends Model
{
    protected $fillable = [
        'grade', 'subject_id'
    ];

    public function subject() {
        return $this->belongsTo(Subject::class);
    }

    public function course() {
        return $this->subject()->course();
    }
}
