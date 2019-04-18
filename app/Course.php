<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    protected $fillable = [
        'name', 'term'
    ];

    protected $appends = ['credit_count'];

    public function subjects() {
        return $this->hasMany(Subject::class);
    }

    public function grades() {
        return $this->with(['subjects', 'subjects.grades']);
    }

    public function getCreditCountAttribute() {
        $total = 0;
        foreach ($this->subjects as $subject)
            $total += $subject->ec_value;
        return $total;
    }
}
