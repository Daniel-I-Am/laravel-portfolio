<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    protected $fillable = [
        'name', 'term'
    ];

    protected $appends = ['credit_count', 'credit_obtained_count'];

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

    public function getCreditObtainedCountAttribute() {
        $total = 0;
        foreach ($this->subjects as $subject) {
            $ecs = $subject->ec_value;
            foreach ($subject->grades as $grade) {
                if ($grade->grade == null || ($grade->lowest_passing != null && $grade->grade < $grade->lowest_passing))
                    $ecs = 0;
            }
            if ($subject->grades->count() == 0 || array_reduce(array_map(function ($value) { return $value['grade']; }, $subject->grades->toArray()), function ($sum, $elem) { return $sum + $elem; }) / $subject->grades->count() < 5.5)
                $ecs = 0;
            $total += $ecs;
        }
        return $total;
    }
}
