<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FinalAssessment extends Model
{
    protected $fillable = ['student_id', 'course_id', 'grade','answer_1','answer_2','answer_3','answer_4','answer_5'];

    public function student()
    {
        return $this->belongsTo(Student::class);
    }

    public function course()
    {
        return $this->belongsTo(Course::class);
    }
}
