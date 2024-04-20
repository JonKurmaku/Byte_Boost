<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    protected $fillable = [
        'lecturer_id',
        'course_id',
        'course_name',
        'num_students_chosen',
        'max_students',
    ];
    public function lecturer()
    {
        return $this->belongsTo('App\Models\Lecturer', 'id');
    }
}
