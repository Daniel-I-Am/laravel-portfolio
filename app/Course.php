<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    protected $fillable = [
        'name', 'term'
    ];

    public function subjects() {
        return $this->hasMany(Subject::class);
    }

    public function grades() {
        return $this->with(['subjects', 'subjects.grades']);
    }
}
